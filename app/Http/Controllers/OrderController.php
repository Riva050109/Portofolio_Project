<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display the checkout form.
     */
    public function showCheckout()
    {
        // Contoh data keranjang belanja (bisa diganti dengan data dari database)
        $cartItems = [
            (object) ['name' => 'Product A', 'quantity' => 2, 'price' => 10.00, 'image' => 'product-a.jpg'],
            (object) ['name' => 'Product B', 'quantity' => 1, 'price' => 20.00, 'image' => 'product-b.jpg'],
        ];

        // Hitung subtotal, diskon, pajak, dan total
        $subtotal = array_sum(array_map(fn($item) => $item->price * $item->quantity, $cartItems));
        $discount = 0; // Contoh diskon (bisa dihitung berdasarkan logika tertentu)
        $tax = $subtotal * 0.10; // Pajak 10%
        $total = $subtotal - $discount + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'discount', 'tax', 'total'));
    }

    /**
     * Handle order placement.
     */
    public function placeOrder(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:cash,dana',
            'dana_id' => [
                'required_if:payment_method,dana',
                'string',
                'max:255',
                'regex:/^\S.*$/', // Pastikan tidak ada spasi di awal
            ],
            'total_amount' => 'required|numeric|min:0.01', // Pastikan total_amount valid
        ], [
            'dana_id.required_if' => 'The DANA ID/Name field is required when using DANA.',
            'dana_id.regex' => 'The DANA ID/Name must not start with a space.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan pesanan ke database
        $order = new Order();
        $order->user_id = auth()->id(); // Ganti dengan ID pengguna yang login
        $order->payment_method = $request->input('payment_method');
        $order->dana_id = $request->input('dana_id'); // Pastikan ini tidak kosong untuk DANA
        $order->total_amount = $request->input('total_amount'); // Ambil total_amount dari form
        $order->status = 'pending'; // Status awal: pending
        $order->save();

        // Redirect ke halaman sukses
        return redirect()->route('order.success')
            ->with('success', 'Your order has been placed successfully!');
    }
}
