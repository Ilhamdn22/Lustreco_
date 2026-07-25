<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $orders = collect();

        if ($request->user()) {
            // Ambil semua orders user dengan relasi items, urutkan terbaru
            $orders = $request->user()
                ->orders()
                ->with('items')
                ->latest()
                ->get();
        }

        return view('account', compact('orders'));
    }
}