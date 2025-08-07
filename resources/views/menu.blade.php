@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Menu <span style="color: #2563eb;">Kami</span>
        </h2>

        <!-- Filter by Category -->
        <div class="mb-8 flex justify-center">
            <div class="inline-flex rounded-md shadow-sm">
                <a href="{{ route('menu') }}"
                    class="px-4 py-2 text-sm font-medium rounded-l-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                    Semua
                </a>
                <a href="{{ route('menu', ['category' => 'food']) }}"
                    class="px-4 py-2 text-sm font-medium border-t border-b border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                    Makanan
                </a>
                <a href="{{ route('menu', ['category' => 'drink']) }}"
                    class="px-4 py-2 text-sm font-medium rounded-r-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                    Minuman
                </a>
            </div>
        </div>

        <!-- Product List -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($products as $product)
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                <!-- Product Image -->
                <div class="h-48 overflow-hidden flex-shrink-0">
                    @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Tidak Ada Gambar</span>
                    </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                    <div class="flex items-center justify-between mt-auto pt-3">
                        <p class="text-blue-600 font-bold text-lg whitespace-nowrap">
                            Rp{{ number_format($product->price, 0) }}</p>
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-shrink-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300 whitespace-nowrap">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada produk tersedia</p>
            </div>
            @endforelse
        </section>
    </div>
</div>
@endsection