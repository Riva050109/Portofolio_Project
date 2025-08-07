<?php
namespace App\Http\Controllers;

use Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
        // Retrieve cart items
        $cartItems = Cart::getContent();

        // Calculate subtotal
        $subtotal = Cart::getSubtotal();

        // Initialize discount and tax
        $discount = 0;
        $taxRate = 0.10; // 10% tax rate
        $tax = $subtotal * $taxRate;

        // Check if a coupon is applied
        $coupon = session('coupon');
        if ($coupon) {
            if ($coupon->type === 'fixed') {
                $discount = $coupon->value;
            } elseif ($coupon->type === 'percentage') {
                $discount = ($subtotal * $coupon->value) / 100;
            }
        }

        // Calculate total
        $total = $subtotal - $discount + $tax;

        // Pass data to the view
        return view('checkout', compact('cartItems', 'subtotal', 'discount', 'tax', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // Validasi data alamat
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $userId = auth()->id();
        $cartItems = Cart::getContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Hitung total
        $subtotal = Cart::getSubtotal();
        $taxRate = 0.10;
        $tax = $subtotal * $taxRate;
        $total = $subtotal + $tax;

        // Generate nomor order unik
        $orderNumber = 'ORD-' . strtoupper(uniqid());

        // Buat order
        $order = Order::create([
            'user_id' => $userId,
            // 'order_number' => $orderNumber,
            'total_amount' => $total,
            'status' => 'completed', // Langsung completed untuk cash
            'payment_method' => 'cash',
            // 'payment_status' => 'paid',
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],

        ]);

        // Simpan item order
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_price' => $item->price * $item->quantity // Hitung total per item
            ]);
        }

        // Kosongkan keranjang
        Cart::clear();

        // Redirect ke halaman order complete dengan data order
        return redirect()->route('order.complete', ['order' => $order->id])
            ->with('success', 'Pembayaran cash berhasil!');
    }

    public function showOrderComplete($order)
    {
        $order = Order::findOrFail($order);
        return view('order-complete', compact('order'));
    }
}