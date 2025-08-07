@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Langkah Pembelian -->
        <div class="mb-12 px-4 sm:px-8">
            <div class="flex items-center justify-between relative">


                <!-- Langkah-langkah -->
                @foreach([] as $index => $step)
                <div class="relative z-10 flex flex-col items-center group">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center 
                        @if($index < 2) bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg transform scale-110 ring-4 ring-blue-200
                        @else bg-white border-2 border-gray-300 text-gray-400 @endif
                        transition-all duration-300 group-hover:scale-105">
                        @if($index < 2) <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <span class="font-bold text-lg">{{ $index + 1 }}</span>
                            @endif
                    </div>
                    <div class="absolute -bottom-7 text-sm font-medium 
                        @if($index < 2) text-blue-600 font-semibold @else text-gray-500 @endif">
                        {{ $step }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Kolom Kiri - Form Pembayaran -->
            <div class="lg:w-2/3">
                <div
                    class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 transition-all hover:shadow-md">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-white opacity-10"></div>
                        <div class="absolute -right-20 top-0 w-64 h-64 rounded-full bg-white opacity-5"></div>
                        <h2 class="text-2xl font-bold mb-1 relative z-10">Detail Pembayaran</h2>
                        <p class="opacity-95 font-light relative z-10">Lengkapi informasi pembelian Anda</p>
                    </div>

                    <!-- Informasi Pengiriman -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center mb-5">
                            <div class="bg-gradient-to-br from-blue-100 to-blue-100 p-2 rounded-lg mr-3 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Informasi Pengiriman</h3>
                        </div>

                        <form id="checkout-form" action="{{ route('order.place') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Nama Lengkap -->
                                <div class="space-y-2">
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
                                    <div class="relative">
                                        <input type="text" name="name" value="{{ auth()->user()->name }}" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                            placeholder="Masukkan nama lengkap">
                                        @error('name')
                                        <p class="text-red-500 text-xs mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="space-y-2">
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                                    <div class="relative">
                                        <input type="email" name="email" value="{{ auth()->user()->email }}" readonly
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400">
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="md:col-span-2 space-y-2">
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Alamat Lengkap</label>
                                    <div class="relative">
                                        <textarea name="address" rows="3" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                            placeholder="Alamat lengkap pengiriman"></textarea>
                                        @error('address')
                                        <p class="text-red-500 text-xs mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kota -->
                                <div class="space-y-2">
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Kota</label>
                                    <div class="relative">
                                        <input type="text" name="city" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                            placeholder="Nama kota">
                                        @error('city')
                                        <p class="text-red-500 text-xs mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kode Pos -->
                                <div class="space-y-2">
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Kode Pos</label>
                                    <div class="relative">
                                        <input type="text" name="postal_code" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                            placeholder="Kode pos">
                                        @error('postal_code')
                                        <p class="text-red-500 text-xs mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="p-6">
                        <div class="bg-white rounded-xl overflow-hidden">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Metode Pembayaran
                            </h2>

                            <div class="space-y-3">
                                <!-- Bayar di Tempat -->
                                <label
                                    class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-1 has-[:checked]:ring-blue-200">
                                    <div class="flex items-center h-5 mr-4 relative">
                                        <input type="radio" name="payment_method" value="cash" class="sr-only peer"
                                            checked>
                                        <div
                                            class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors">
                                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800 flex items-center">
                                            Bayar di Tempat (COD)
                                            <span
                                                class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Rekomendasi</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Bayar ketika pesanan diterima</p>
                                    </div>
                                    <div class="ml-4 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </label>

                                <!-- DANA E-Wallet -->
                                <label
                                    class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-1 has-[:checked]:ring-blue-200">
                                    <div class="flex items-center h-5 mr-4 relative">
                                        <input type="radio" name="payment_method" value="dana" class="sr-only peer">
                                        <div
                                            class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors">
                                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800">DANA E-Wallet</div>
                                        <p class="text-sm text-gray-500 mt-1">Bayar menggunakan saldo DANA</p>
                                    </div>
                                    <div class="ml-4 text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z" />
                                        </svg>
                                    </div>
                                </label>

                                <!-- Transfer Bank -->
                                <label
                                    class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-300 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:ring-1 has-[:checked]:ring-blue-200">
                                    <div class="flex items-center h-5 mr-4 relative">
                                        <input type="radio" name="payment_method" value="bank_transfer"
                                            class="sr-only peer">
                                        <div
                                            class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors">
                                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800">Transfer Bank</div>
                                        <p class="text-sm text-gray-500 mt-1">Bayar melalui transfer bank</p>
                                    </div>
                                    <div class="ml-4 text-purple-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Ringkasan Pesanan -->
            <div class="lg:w-1/3">
                <div
                    class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 sticky top-6 transition-all hover:shadow-md">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-white opacity-10"></div>
                        <div class="absolute -right-20 top-0 w-64 h-64 rounded-full bg-white opacity-5"></div>
                        <h3 class="text-xl font-bold flex items-center relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Ringkasan Pesanan
                        </h3>
                    </div>

                    <!-- Daftar Item -->
                    <div class="p-6 max-h-96 overflow-y-auto custom-scrollbar">
                        <ul class="divide-y divide-gray-100">
                            @foreach ($cartItems as $item)
                            <li class="py-4 flex items-start group">
                                <div
                                    class="flex-shrink-0 relative overflow-hidden rounded-lg shadow-sm border border-gray-200 group-hover:shadow-md transition-all">
                                    <div class="relative">
                                        @php
                                        $imagePath = $item->image ? 'menu_images/' . $item->image : null;
                                        @endphp

                                        @if(filter_var($item->image, FILTER_VALIDATE_URL))
                                        <!-- Gambar dari URL eksternal -->
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                            class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                        @elseif($imagePath && Storage::disk('public')->exists($imagePath))
                                        <!-- Gambar lokal yang ada -->
                                        <img src="{{ asset('storage/'.$imagePath) }}" alt="{{ $item->name }}"
                                            class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                        @else
                                        <!-- Fallback untuk semua kasus gambar tidak tersedia -->
                                        <div
                                            class="w-20 h-20 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        @endif

                                        <span
                                            class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1 min-w-0">
                                    <h4 class="font-medium text-gray-800 truncate">{{ $item->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Rp{{ number_format($item->price, 0) }} ×
                                        {{ $item->quantity }}</p>
                                </div>
                                <div class="ml-4 font-semibold text-gray-800">
                                    Rp{{ number_format($item->price * $item->quantity, 0) }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Rincian Harga -->
                    <div class="p-6 border-t border-gray-100">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-800 font-medium">Rp{{ number_format($subtotal, 0) }}</span>
                            </div>
                            @if (isset($discount) && $discount > 0)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diskon</span>
                                <span class="text-blue-600 font-medium">-Rp{{ number_format($discount, 0) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span class="text-gray-800 font-medium">Rp{{ number_format($tax, 0) }}</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-200">
                                <span class="text-gray-800 font-semibold">Total</span>
                                <span class="text-blue-600 text-lg font-bold">Rp{{ number_format($total, 0) }}</span>
                            </div>
                        </div>

                        <!-- Kode Promo -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Promo</label>
                            <div class="flex rounded-lg overflow-hidden shadow-sm">
                                <input type="text" name="promo_code" placeholder="Masukkan kode promo"
                                    class="flex-1 px-4 py-3 border border-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400">
                                <button type="button"
                                    class="px-4 py-3 bg-gradient-to-b from-gray-50 to-gray-100 text-gray-700 font-medium hover:from-gray-100 hover:to-gray-200 transition-colors border-l border-gray-200">
                                    Gunakan
                                </button>
                            </div>
                            @error('promo_code')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Tombol Pesan Sekarang -->
                        <div class="mt-6">
                            <input type="hidden" name="total_amount" value="{{ $total }}">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-4 px-6 rounded-lg font-bold transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center shadow-md hover:shadow-lg active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Pesan Sekarang (Rp{{ number_format($total, 0) }})
                            </button>
                        </div>

                        <!-- Info Keamanan -->
                        <div class="mt-4 flex items-center text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Pembayaran aman dengan enkripsi SSL
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<style>
/* Custom scrollbar styling */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi saat form mendapat fokus
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-1', 'ring-blue-300');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-1', 'ring-blue-300');
        });
    });

    // Animasi pemilihan metode pembayaran
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            document.querySelectorAll('label[for="' + this.id + '"]').forEach(label => {
                label.classList.remove('ring-blue-200');
                if (this.checked) {
                    label.classList.add('ring-1', 'ring-blue-200');
                }
            });
        });
    });
});
</script>
@endsection