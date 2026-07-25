<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    /**
     * Tampilkan isi keranjang.
     */
    public function index(Request $request)
    {
        $cart = session('cart', []);

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        // Rekomendasi produk untuk carousel "Recently Ordered"
        $products = collect();

        try {
            $response = Http::withoutVerifying()->get('https://fakestoreapi.com/products?limit=8');

            if ($response->successful()) {
                $products = collect($response->json())->map(function ($apiProduct) {
                    $product = new \stdClass();
                    $product->id = $apiProduct['id'];
                    $product->name = $apiProduct['title'];
                    $product->price = (int) round($apiProduct['price'] * 15000);
                    $product->image = $apiProduct['image'];

                    return $product;
                });
            }
        } catch (\Throwable $e) {
            // Kalau API sedang down, carousel cukup dikosongkan, tidak perlu error ke user
        }

        return view('cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'products' => $products,
        ]);
    }

    /**
     * Tambahkan produk ke keranjang.
     * product_id, quantity, & size dikirim lewat body request.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'nullable|integer|min:1',
            'size' => 'nullable|string|max:20',
        ]);

        $id = $validated['product_id'];
        $quantity = max(1, (int) ($validated['quantity'] ?? 1));
        $size = $validated['size'] ?? 'One Size';

        if (strpos($id, 'db-') === 0) {
            $dbId = str_replace('db-', '', $id);
            $dbProduct = \App\Models\Product::find($dbId);
            if (!$dbProduct) {
                return back()->with('error', 'Produk tidak ditemukan.');
            }
            $productData = [
                'id' => 'db-' . $dbProduct->id,
                'name' => $dbProduct->name,
                'price' => (int) $dbProduct->price,
                'image' => $dbProduct->image,
            ];
        } else {
            $response = Http::withoutVerifying()->get("https://fakestoreapi.com/products/{$id}");

            if (! $response->successful()) {
                return back()->with('error', 'Produk tidak ditemukan.');
            }

            $apiProduct = $response->json();
            if (!$apiProduct) {
                return back()->with('error', 'Produk tidak ditemukan.');
            }
            $productData = [
                'id' => $apiProduct['id'],
                'name' => $apiProduct['title'],
                'price' => (int) round($apiProduct['price'] * 15000),
                'image' => $apiProduct['image'],
            ];
        }

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $productData['id'],
                'name' => $productData['name'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'size' => $size,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Ubah jumlah (quantity) item di keranjang. $key = product id di dalam session cart.
     */
    public function update(Request $request, $key)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = (int) $request->input('quantity');
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Keranjang diperbarui.');
    }

    /**
     * Hapus item dari keranjang. $key = product id di dalam session cart.
     */
    public function remove($key)
    {
        $cart = session('cart', []);

        unset($cart[$key]);

        session(['cart' => $cart]);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}