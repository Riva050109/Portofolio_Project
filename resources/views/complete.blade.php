@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-success text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="bi bi-check-circle-fill me-2"></i> Order Confirmed</h3>
                        <span class="badge bg-white text-success fs-6">#{{ $order->order_number }}</span>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Success Message -->
                    <div class="text-center mb-5">
                        <div class="mb-4">
                            <div class="success-animation">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                </svg>
                            </div>
                        </div>
                        <h2 class="fw-bold text-success mb-3">Thank You for Your Order!</h2>
                        <p class="lead">We've received your order and it's being processed.</p>
                        <p>A confirmation email has been sent to
                            <strong>{{ auth()->user()->email ?? 'your email' }}</strong></p>
                    </div>

                    <!-- Order Summary -->
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-receipt me-2"></i> Order Details</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between">
                                            <span class="text-muted">Order Date:</span>
                                            <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between">
                                            <span class="text-muted">Payment Method:</span>
                                            <span class="text-capitalize">{{ $order->payment_method }}</span>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between">
                                            <span class="text-muted">Status:</span>
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success">{{ ucfirst($order->status) }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span class="text-muted">Total Amount:</span>
                                            <span class="fw-bold">Rp{{ number_format($order->total, 0) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-truck me-2"></i> Delivery Information</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Shipping Address</h6>
                                    <address>
                                        {{ $order->customer_name }}<br>
                                        {{ $order->address }}<br>
                                        {{ $order->city }}, {{ $order->postal_code }}<br>
                                        {{ $order->province ?? '' }}<br>
                                        Phone: {{ $order->phone }}
                                    </address>
                                    <hr>
                                    <h6 class="fw-bold mb-3">Shipping Method</h6>
                                    <p class="mb-0">{{ $order->shipping_method ?? 'Standard Delivery' }} (Estimated
                                        delivery: 2-3 business days)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card border-0 shadow-sm mb-5">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-cart-check me-2"></i> Order Items</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0" width="50%">Product</th>
                                            <th class="border-0 text-center">Price</th>
                                            <th class="border-0 text-center">Qty</th>
                                            <th class="border-0 text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->product->image_url ?? asset('images/default-product.jpg') }}"
                                                        alt="{{ $item->product_name }}" class="img-fluid rounded me-3"
                                                        width="60">
                                                    <div>
                                                        <h6 class="mb-1">{{ $item->product_name }}</h6>
                                                        <small class="text-muted">SKU:
                                                            {{ $item->product_sku ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">Rp{{ number_format($item->price, 0) }}
                                            </td>
                                            <td class="align-middle text-center">{{ $item->quantity }}</td>
                                            <td class="align-middle text-end">
                                                Rp{{ number_format($item->price * $item->quantity, 0) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Subtotal</td>
                                            <td class="text-end">Rp{{ number_format($order->subtotal, 0) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Shipping</td>
                                            <td class="text-end">Rp{{ number_format($order->shipping_cost, 0) }}</td>
                                        </tr>
                                        @if($order->discount > 0)
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Discount</td>
                                            <td class="text-end text-danger">-Rp{{ number_format($order->discount, 0) }}
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Total</td>
                                            <td class="text-end fw-bold">Rp{{ number_format($order->total, 0) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Support & Next Steps -->
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-headset text-primary mb-3" style="font-size: 2.5rem;"></i>
                                    <h5>Need Help?</h5>
                                    <p class="mb-4">Our customer service team is ready to assist you with any questions
                                        about your order.</p>
                                    <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-envelope me-2"></i> Contact Us
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-box-seam text-success mb-3" style="font-size: 2.5rem;"></i>
                                    <h5>Track Your Order</h5>
                                    <p class="mb-4">You can track your order status anytime in your account dashboard.
                                    </p>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">
                                        <i class="bi bi-truck me-2"></i> Track Order
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5 py-3 me-3">
                            <i class="bi bi-house-door me-2"></i> Back to Home
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary px-5 py-3">
                            <i class="bi bi-bag me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.success-animation {
    margin: 0 auto;
    width: 100px;
    height: 100px;
}

.checkmark {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: block;
    stroke-width: 4;
    stroke: #28a745;
    stroke-miterlimit: 10;
    box-shadow: 0 0 0 rgba(40, 167, 69, 0.4);
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 4;
    stroke-miterlimit: 10;
    stroke: #28a745;
    fill: none;
    animation: stroke .6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke .3s cubic-bezier(0.65, 0, 0.45, 1) .8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {

    0%,
    100% {
        transform: none;
    }

    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0 0 0 100px rgba(40, 167, 69, 0.1);
    }
}

.card {
    border-radius: 12px;
    overflow: hidden;
}

.table th,
.table td {
    vertical-align: middle;
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 600;
}
</style>
@endsection