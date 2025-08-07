<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = \Cart::getContent();
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        Cart::add([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => 1,
        ]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
    /**
     * Add a product to the cart.
     */
  public function addToCart(Request $request)
{
    // Validasi input
    $validatedData = Validator::make($request->all(), [
        'product_id' => 'required|exists:products,id',
    ]);

    if ($validatedData->fails()) {
        return redirect()->back()->withErrors($validatedData)->withInput();
    }

    $product = Product::find($request->input('product_id'));
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    \Cart::add([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => 1,
        'attributes' => [
        'image' => $product->image_path, // Make sure this is the correct path
        ]
    ]);

    return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
}
    public function decreaseQuantity($id)
{
    $item = Cart::get($id);
    if ($item && $item->quantity > 1) {
        Cart::update($id, ['quantity' => -1]); // Decrease by 1
    } else {
        Cart::remove($id); // Remove the item if quantity is 1
    }

    return redirect()->route('cart.index')->with('success', 'Quantity updated successfully.');
}

public function increaseQuantity($id)
{
    Cart::update($id, ['quantity' => 1]); // Increase by 1
    return redirect()->route('cart.index')->with('success', 'Quantity updated successfully.');
}

public function removeItem($id)
{
    Cart::remove($id);
    return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
}

    /**
     * Apply a coupon to the cart.
     */public function applyCoupon(Request $request)
{
    $couponCode = $request->input('code'); // Sesuaikan dengan name="code" di form

    // Validate the coupon
    $coupon = Coupon::where('code', $couponCode)
        ->where(function ($query) {
            $query->where('valid_until', '>=', now())
                ->orWhereNull('valid_until');
        })
        ->where(function ($query) {
            $query->whereNull('usage_limit')
                ->orWhere('usage_limit', '>', 0);
        })
        ->first();

    if (!$coupon) {
        return redirect()->back()->with('coupon_error', 'Invalid or expired coupon.');
    }

    // Save the coupon in the session
    session(['coupon' => $coupon]);

    // Optionally decrement usage limit
    if ($coupon->usage_limit !== null) {
        $coupon->decrement('usage_limit');
    }

    return redirect()->back()->with('coupon_success', 'Coupon applied successfully!');
}
    /**
     * Place an order from the cart.
     */
    public function placeOrder(Request $request)
    {
        $userId = auth()->id(); // Get the authenticated user's ID
        $cartItems = Cart::getContent();
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
        $totalPrice = $subtotal - $discount + $tax;

        // Get the authenticated user
        $user = auth()->user();

        // Validate payment method
        $paymentMethod = $request->input('payment_method'); // e.g., 'cash' or 'dana'
        if ($paymentMethod === 'dana') {
            // Check if the user has enough balance for DANA payment
            if ($user->balance < $totalPrice) {
                return redirect()->route('checkout')->with('error', 'Insufficient balance in your virtual wallet.');
            }

            // Deduct balance for DANA payment
            $user->decrement('balance', $totalPrice);
        }

        // Create or update the order
        $order = Order::create([
            'user_id' => $userId,
            'payment_method' => $paymentMethod,
            'total_amount' => $totalPrice, // Use the correct column name
            'status' => 'completed', // Mark as completed after payment
        ]);

        // Add the products to the order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Clear the cart after placing the order
        Cart::clear();

        // Clear the coupon from the session
        session()->forget('coupon');

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}