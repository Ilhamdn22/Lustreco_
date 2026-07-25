<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configurations
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    /**
     * Get Midtrans Snap Token for an order.
     */
    public function getSnapToken(Order $order)
    {
        // Pastikan user adalah pemilik order tersebut
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        // Jika snap_token sudah ada di database, langsung kembalikan
        if ($order->snap_token) {
            return response()->json(['snap_token' => $order->snap_token]);
        }

        try {
            $midtransOrderId = $order->id . '-' . time();
            session(['midtrans_order_id_' . $order->id => $midtransOrderId]);

            // Persiapkan parameter untuk Midtrans Snap
            $params = [
                'transaction_details' => [
                    'order_id' => $midtransOrderId, // Menjamin keunikan id transaksi di Midtrans
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $order->recipient_name,
                    'email' => $order->email,
                    'phone' => $order->recipient_phone,
                ],
                'item_details' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->product_id,
                        'price' => (int) $item->price,
                        'quantity' => (int) $item->quantity,
                        'name' => substr($item->product_name, 0, 50), // Midtrans membatasi nama item maks 50 karakter
                    ];
                })->toArray(),
            ];

            // Filter metode pembayaran di Snap sesuai pilihan user di checkout
            $enabledPayments = [];
            switch ($order->payment_method) {
                case 'BCA Virtual Account':
                    $enabledPayments = ['bca_va'];
                    break;
                case 'Mandiri Virtual Account':
                    $enabledPayments = ['echannel']; // 'echannel' is the Midtrans identifier for Mandiri Bill Payment
                    break;
                case 'BNI Virtual Account':
                    $enabledPayments = ['bni_va'];
                    break;
                case 'BRI Virtual Account':
                    $enabledPayments = ['bri_va'];
                    break;
                case 'Permata Virtual Account':
                    $enabledPayments = ['permata_va'];
                    break;
                case 'Other Banks VA':
                    $enabledPayments = ['other_va'];
                    break;
                case 'Bank Transfer':
                    $enabledPayments = ['bca_va', 'bni_va', 'bri_va', 'permata_va', 'other_va', 'echannel'];
                    break;
                case 'QRIS':
                    $enabledPayments = ['qris', 'gopay', 'shopeepay'];
                    break;
                case 'Credit Card':
                    $enabledPayments = ['credit_card'];
                    break;
                case 'E-Wallet':
                    $enabledPayments = ['gopay', 'shopeepay'];
                    break;
            }

            if (!empty($enabledPayments)) {
                $params['enabled_payments'] = $enabledPayments;
            }

            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap_token ke database
            $order->update(['snap_token' => $snapToken]);

            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat token pembayaran: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Webhook callback handler dari Midtrans.
     */
    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $fraudStatus = $notification->fraud_status;

            // Dapatkan ID order asli dari order_id transaksi Midtrans (format: order_id-timestamp)
            $midtransOrderId = $notification->order_id;
            $parts = explode('-', $midtransOrderId);
            $orderId = $parts[0];

            $order = Order::findOrFail($orderId);

            Log::info("Midtrans Webhook: Order #{$orderId} status is {$transactionStatus}");

            if ($transactionStatus == 'capture') {
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $order->update([
                            'payment_status' => 'pending',
                            'status' => 'pending'
                        ]);
                    } else {
                        $order->update([
                            'payment_status' => 'success',
                            'status' => 'processing'
                        ]);
                    }
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update([
                    'payment_status' => 'success',
                    'status' => 'processing'
                ]);
            } elseif ($transactionStatus == 'pending') {
                $order->update([
                    'payment_status' => 'pending',
                    'status' => 'pending'
                ]);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update([
                    'payment_status' => 'failed',
                    'status' => 'cancelled'
                ]);
            }

            return response()->json(['status' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Menyimulasikan pembayaran sukses secara lokal (Local Dev helper).
     */
    public function simulateSuccess(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $order->update([
            'payment_status' => 'success',
            'status' => 'processing'
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Simulasi pembayaran berhasil! Status pesanan kini telah lunas.');
    }
}
