@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pending Orders</h2>
    <div class="space-y-4">
        @forelse ($orders as $order)
        <div class="bg-white rounded-lg shadow-md p-6">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>DANA ID/Name:</strong> {{ $user->name }}</p>
            <p><strong>Total Amount:</strong> Rp{{ number_format($order->amount, 2) }}</p>
            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                @csrf
                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Approve
                </button>
            </form>
        </div>
        @empty
        <p>No pending orders.</p>
        @endforelse
    </div>
</div>
@endsection