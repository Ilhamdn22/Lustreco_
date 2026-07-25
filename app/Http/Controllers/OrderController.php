<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Transaction;

class OrderController extends Controller
{
    /**
     * Tampilkan halaman checkout.
     * Support: dari keranjang atau langsung (Buy Now).
     */
    public function checkout(Request $request)
    {
        try {
            $items = collect();
            $total = 0;

            // Cek apakah ada parameter product_id (Buy Now)
            if ($request->has('product_id')) {
                $productId = $request->query('product_id');
                $quantity = max(1, (int) $request->query('quantity', 1));

                if (strpos($productId, 'db-') === 0) {
                    $dbId = str_replace('db-', '', $productId);
                    $dbProduct = \App\Models\Product::find($dbId);
                    if (!$dbProduct) {
                        return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
                    }
                    $product = (object) [
                        'id' => 'db-' . $dbProduct->id,
                        'name' => $dbProduct->name,
                        'price' => (int) $dbProduct->price,
                        'image' => $dbProduct->image,
                    ];
                } else {
                    // Ambil produk dari API
                    $response = Http::withoutVerifying()->get("https://fakestoreapi.com/products/{$productId}");
                    if ($response->successful() && $apiProduct = $response->json()) {
                        $product = (object) [
                            'id' => $apiProduct['id'],
                            'name' => $apiProduct['title'],
                            'price' => (int) round($apiProduct['price'] * 15000),
                            'image' => $apiProduct['image'],
                        ];
                    } else {
                        return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
                    }
                }

                $item = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => $quantity,
                ];

                // Simpan di session sementara untuk diproses di store
                session(['buy_now' => $item]);

                $items = collect([$item]);
                $total = $product->price * $quantity;
            } else {
                // Ambil dari cart session
                $cart = session('cart', []);
                if (empty($cart)) {
                    return redirect()->route('cart.index')->with('error', 'Keranjang kamu masih kosong.');
                }
                $items = collect($cart)->values();
                $total = $items->sum(fn($item) => $item['price'] * $item['quantity']);
            }

            return view('checkout', compact('items', 'total'));

        } catch (\Exception $e) {
            Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memuat halaman checkout.');
        }
    }

    /**
     * Proses checkout: simpan order.
     */
    public function store(Request $request)
    {
        try {
            // Pastikan user login
            $user = $request->user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
            }

            // Cek apakah ada Buy Now
            $buyNow = session('buy_now', null);

            if ($buyNow) {
                $items = collect([$buyNow]);
                $total = $buyNow['price'] * $buyNow['quantity'];
                session()->forget('buy_now');
            } else {
                $cart = session('cart', []);
                if (empty($cart)) {
                    return redirect()->route('cart.index')->with('error', 'Keranjang kamu masih kosong.');
                }
                $items = collect($cart)->values();
                $total = $items->sum(fn($item) => $item['price'] * $item['quantity']);
            }

            // Validasi input
            $validated = $request->validate([
                'recipient_name' => 'required|string|max:255',
                'shipping_address' => 'required|string|max:1000',
                'phone' => 'required|string|max:30',
                'payment_method' => 'required|string|max:100',
            ]);

            // Simpan order ke database
            $order = DB::transaction(function () use ($request, $validated, $items, $total, $user) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => 'pending',
                    'subtotal' => $total,
                    'total' => $total,
                    'recipient_name' => $validated['recipient_name'],
                    'recipient_phone' => $validated['phone'],
                    'email' => $user->email,
                    'address' => $validated['shipping_address'],
                    'payment_method' => $validated['payment_method'],
                ]);

                foreach ($items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'product_image' => $item['image'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['price'] * $item['quantity'],
                    ]);
                }

                return $order;
            });

            // Kosongkan cart jika bukan Buy Now
            if (!$buyNow) {
                session()->forget('cart');
            }

            return redirect()->route('orders.show', $order)
                ->with('success', 'Pesanan #' . $order->id . ' berhasil dibuat. Silakan selesaikan pembayaran.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Order store error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Tampilkan detail order (untuk link "View" di account).
     */
    public function show($id)
    {
        try {
            $order = Order::with('items')->findOrFail($id);

            // Pastikan user hanya bisa melihat order miliknya sendiri
            if ($order->user_id !== auth()->id()) {
                abort(403, 'Unauthorized access to this order.');
            }

            // Fallback status check jika webhook belum masuk/tidak bisa masuk (e.g. localhost)
            if ($order->payment_status === 'pending') {
                $midtransOrderId = session('midtrans_order_id_' . $order->id);
                if ($midtransOrderId) {
                    try {
                        Config::$serverKey = config('services.midtrans.server_key');
                        Config::$isProduction = config('services.midtrans.is_production');

                        $status = Transaction::status($midtransOrderId);
                        $transactionStatus = $status->transaction_status ?? null;

                        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                            $order->update([
                                'payment_status' => 'success',
                                'status' => 'processing',
                            ]);
                            $order->refresh();
                            session()->forget('midtrans_order_id_' . $order->id);
                        }
                    } catch (\Exception $e) {
                        Log::warning('Midtrans status pull warning: ' . $e->getMessage());
                    }
                }
            }

            return view('orders.show', compact('order'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Order not found.');
        } catch (\Exception $e) {
            Log::error('Order show error: ' . $e->getMessage());
            return redirect()->route('account')->with('error', 'Gagal memuat detail order.');
        }
    }
}