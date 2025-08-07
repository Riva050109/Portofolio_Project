@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Transfer Money</h2>
    <form action="{{ route('transfer.process') }}" method="POST" class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        @csrf
        <div class="mb-4">
            <label for="recipient_email" class="block text-gray-700 font-bold mb-2">Recipient Email</label>
            <input type="email" name="recipient_email" id="recipient_email" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-bold mb-2">Amount (IDR)</label>
            <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required min="1000">
        </div>
        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors duration-300">
            Transfer
        </button>
    </form>
</div>
@endsection
