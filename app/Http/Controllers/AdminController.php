<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display all pending orders.
     */
    public function index()
    {
        $orders = Order::where('status', 'pending')->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Approve an order and deduct balance if payment method is DANA.
     */
    public function approve($id)
    {
        // Temukan pesanan
        $order = Order::findOrFail($id);

        // Pastikan pesanan menggunakan metode pembayaran DANA
        if ($order->payment_method === 'dana') {
            // Ambil pengguna yang terkait dengan pesanan
            $user = $order->user;

            // Kurangi saldo pengguna sesuai total pesanan
            if ($user->balance >= $order->total_amount) {
                $user->balance -= $order->total_amount;
                $user->save();
            } else {
                return redirect()->back()->withErrors('Insufficient balance for this order.');
            }
        }

        // Ubah status pesanan menjadi "approved"
        $order->status = 'approved';
        $order->save();

        return redirect()->back()->with('success', 'Order approved successfully.');
    }
}