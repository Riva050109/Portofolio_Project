<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbord</title>
    <!-- Tailwind CSS CDN -->

    @vite('resources/css/app.css')
    <style>
    /* Custom CSS for Infinite Scroll */
    .animate-infinite-scroll {
        display: flex;
        animation: scroll-left 15s linear infinite;
    }

    @keyframes scroll-left {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }
    </style>
</head>

<body class="min-h-screen bg-blue-50">
    <!-- Header Profile Section -->
    <div class="bg-blue-600 text-white p-6 pb-12 rounded-b-[2rem]">
        <div class="flex justify-between items-start mb-6">
            <div class="flex items-center space-x-3">
                <div
                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold text-xl shadow-sm">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm text-blue-100">Hello,</p>
                    <h2 class="font-bold">{{ $user->name }}</h2>
                </div>
            </div>
            <button class="p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
        </div>
        <!-- Balance Card -->
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-center mb-3">
                <p class="text-blue-600 text-sm font-medium">Your Balance</p>
                <button class="text-blue-600 text-sm">Hide</button>
            </div>
            <div class="flex justify-between items-center">
                <h3 class="text-gray-900 text-2xl font-bold">Rp{{ number_format($user->balance, 2) }}</h3>
                <a href="{{ route('balance.show') }}" class="text-blue-600 text-sm flex items-center">
                    <span>Top Up</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <!-- Main Actions Grid -->
    <div class="bg-white rounded-t-[2rem] -mt-6 p-6">
        <div class="grid grid-cols-4 gap-4 mb-8">
            <a href="{{ route('balance.show') }}" class="flex flex-col items-center space-y-2">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <span class="text-xs text-gray-600 text-center">Top Up</span>
            </a>
            <a href="{{ route('transfer.form') }}" class="flex flex-col items-center space-y-2">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7l4-4m0 0l4 4m-4-4v18" />
                    </svg>
                </div>
                <span class="text-xs text-gray-600 text-center">Send</span>
            </a>
            <a href="{{ route('history') }}" class="flex flex-col items-center space-y-2">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-xs text-gray-600 text-center">History</span>
            </a>
            <a href="{{ route('settings') }}" class="flex flex-col items-center space-y-2">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-xs text-gray-600 text-center">More</span>
            </a>
        </div>
        <!-- Promotions Carousel -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Special Offers</h3>
            <div class="relative overflow-hidden rounded-xl">
                <div class="flex gap-4 animate-infinite-scroll">
                    <!-- Original Promotions -->
                    @foreach($promotions as $promotion)
                    <div class="min-w-[280px] shrink-0 rounded-xl overflow-hidden shadow-sm">
                        <img src="{{ $promotion['image'] }}" alt="{{ $promotion['title'] }}"
                            class="w-full h-32 object-cover">
                        <div class="p-3 bg-white">
                            <h4 class="font-semibold text-sm text-gray-800">{{ $promotion['title'] }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $promotion['description'] }}</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- Duplicate Promotions for Infinite Effect -->
                    @foreach($promotions as $promotion)
                    <div class="min-w-[280px] shrink-0 rounded-xl overflow-hidden shadow-sm">
                        <img src="{{ $promotion['image'] }}" alt="{{ $promotion['title'] }}"
                            class="w-full h-32 object-cover">
                        <div class="p-3 bg-white">
                            <h4 class="font-semibold text-sm text-gray-800">{{ $promotion['title'] }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $promotion['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Transaction History -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Transactions</h3>
            @if($transactions->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">No transactions yet</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($transactions as $transaction)
                <div class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                            @if($transaction->type === 'top-up')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            @elseif($transaction->type === 'transfer')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7l4 4m0 0l4-4m-4 4V3" />
                            </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ ucfirst($transaction->type) }}</p>
                            <p class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y • H:i') }}</p>
                        </div>
                    </div>
                    <p
                        class="@if($transaction->type === 'top-up' || $transaction->type === 'receive') text-green-600 @else text-red-600 @endif font-semibold">
                        {{ $transaction->type === 'top-up' || $transaction->type === 'receive' ? '+' : '-' }}Rp{{ number_format($transaction->amount, 2) }}
                    </p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @if (session('order_approved'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
            Your order has been approved, and your balance has been updated.
        </div>
        @endif
    </div>
</body>

</html>