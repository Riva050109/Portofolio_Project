@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Order Placed Successfully!</h2>
        <p class="text-gray-600 mb-4">
            Your order has been placed and is awaiting approval.
        </p>
        <p class="text-gray-600">
            You will receive a notification once the payment is approved.
        </p>
    </div>
</div>
@endsection
