@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Transaction History</h2>
    <div class="bg-white rounded-lg shadow-md p-6">
        @if($transactions->isEmpty())
            <p class="text-gray-600">No transactions found.</p>
        @else
            <ul class="space-y-4">
                @foreach($transactions as $transaction)
                    <li class="flex justify-between items-center border-b pb-4 mb-4">
                        <div>
                            <p class="font-semibold text-gray-800">{{ ucfirst($transaction->type) }}</p>
                            <p class="text-sm text-gray-600">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            @if($transaction->type === 'top-up' || $transaction->type === 'receive')
                                <p class="text-green-600 font-bold">+Rp{{ number_format($transaction->amount, 2) }}</p>
                            @elseif($transaction->type === 'transfer')
                                <p class="text-red-600 font-bold">-Rp{{ number_format($transaction->amount, 2) }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
