<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Kontainer Utama Keranjang -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header Keranjang dengan Latar Gradien -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-white/20 p-2 rounded-full mr-4 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Keranjang Belanja Anda</h1>
                        <p class="text-sm opacity-90">Tinjau dan kelola item Anda</p>
                    </div>
                </div>
                <div class="bg-white/20 px-4 py-2 rounded-full backdrop-blur-sm">
                    <span class="text-sm font-medium">
                        <span class="font-bold"><?php echo e(\Cart::getContent()->count()); ?></span>
                        <?php echo e(\Cart::getContent()->count() === 1 ? 'Item' : 'Item'); ?>

                    </span>
                </div>
            </div>
        </div>

        <!-- Pesan Sukses -->
        <?php if(session('success')): ?>
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mx-6 mt-4 rounded-lg flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700 font-medium"><?php echo e(session('success')); ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Keranjang Kosong -->
        <?php if(\Cart::getContent()->count() == 0): ?>
        <div class="p-8 text-center">
            <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                <svg class="h-12 w-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Keranjang Anda kosong</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-6">Sepertinya Anda belum menambahkan item ke keranjang.</p>
            <a href="<?php echo e(url('/menu')); ?>"
                class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Lihat Menu
            </a>
        </div>
        <?php else: ?>
        <!-- Isi Keranjang -->
        <div class="p-6">
            <!-- Header Tabel Desktop -->
            <div
                class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-3 rounded-lg text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <div class="col-span-5">Produk</div>
                <div class="col-span-2 text-center">Harga</div>
                <div class="col-span-2 text-center">Jumlah</div>
                <div class="col-span-2 text-center">Subtotal</div>
                <div class="col-span-1 text-right">Aksi</div>
            </div>

            <!-- Item Keranjang -->
            <div class="divide-y divide-gray-100">
                <?php $__currentLoopData = \Cart::getContent(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    class="py-4 md:py-6 grid grid-cols-2 md:grid-cols-12 gap-4 items-center transition-all duration-200 hover:bg-gray-50/50 rounded-lg px-2">
                    <!-- Info Produk -->
                    <div class="col-span-2 md:col-span-5 flex items-center">
                        <div
                            class="relative w-16 h-16 md:w-20 md:h-20 bg-gray-50 rounded-lg overflow-hidden mr-4 flex-shrink-0 border border-gray-200">
                            <?php if($item->attributes->image): ?>
                            <img src="<?php echo e(asset('storage/'.$item->attributes->image)); ?>" alt="<?php echo e($item->name); ?>"
                                class="w-full h-full object-cover object-center">
                            <?php else: ?>
                            <img src="<?php echo e(asset('storage' . $item->image)); ?>" alt="<?php echo e($item->name); ?>"
                                class="w-full h-full object-cover object-center">
                            <?php endif; ?>
                            <span
                                class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center text-[10px]">
                                <?php echo e($item->quantity); ?>

                            </span>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-gray-800 text-base md:text-lg truncate"><?php echo e($item->name); ?></h3>
                            <?php if($item->attributes->description): ?>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-1"><?php echo e($item->attributes->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="col-span-1 md:col-span-2 text-center">
                        <div class="text-sm text-gray-500 md:hidden mb-1">Harga</div>
                        <div class="text-gray-700 font-medium">
                            Rp <?php echo e(number_format($item->price, 0)); ?>

                        </div>
                    </div>

                    <!-- Kontrol Jumlah -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="text-sm text-gray-500 md:hidden mb-1 text-center">Jumlah</div>
                        <div class="flex items-center justify-center">
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <form action="<?php echo e(route('cart.decrease', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?>
                                    <button type="submit"
                                        class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white hover:bg-gray-50 text-gray-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                </form>

                                <span
                                    class="w-10 h-8 md:h-10 flex items-center justify-center bg-white text-gray-800 font-medium text-sm border-x border-gray-200">
                                    <?php echo e($item->quantity); ?>

                                </span>

                                <form action="<?php echo e(route('cart.increase', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?>
                                    <button type="submit"
                                        class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white hover:bg-gray-50 text-gray-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="col-span-1 md:col-span-2 text-center">
                        <div class="text-sm text-gray-500 md:hidden mb-1">Subtotal</div>
                        <div class="font-semibold text-gray-800">
                            Rp <?php echo e(number_format($item->price * $item->quantity, 0)); ?>

                        </div>
                    </div>

                    <!-- Tombol Hapus -->
                    <div class="col-span-1 flex justify-start md:justify-end -ml-1 md:ml-0">
                        <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?>
                            <button type="submit"
                                class="text-gray-400 hover:text-red-500 transition-colors p-1 rounded-full hover:bg-red-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="mt-8 bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rp <?php echo e(number_format(\Cart::getSubtotal(), 0)); ?></span>
                    </div>

                    <?php if(session('coupon')): ?>
                    <div class="flex justify-between text-blue-600">
                        <span>Diskon</span>
                        <span>- Rp
                            <?php echo e(number_format(session('coupon')->type === 'fixed' ? session('coupon')->value : (\Cart::getSubtotal() * session('coupon')->value) / 100, 0)); ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkir (5%)</span>
                        <span class="font-medium">Rp <?php echo e(number_format(\Cart::getSubtotal() * 0.10, 0)); ?></span>
                    </div>

                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <div class="flex justify-between">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-blue-600">
                                Rp
                                <?php echo e(number_format(\Cart::getSubtotal() - (session('coupon') ? (session('coupon')->type === 'fixed' ? session('coupon')->value : (\Cart::getSubtotal() * session('coupon')->value) / 100) : 0) + (\Cart::getSubtotal() * 0.10), 0)); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Checkout -->
                <div class="mt-6">
                    <a href="<?php echo e(url('/checkout')); ?>"
                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg text-center transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Lanjut ke Pembayaran
                        </div>
                    </a>
                </div>
            </div>

            <!-- Lanjut Belanja -->
            <div class="mt-6 text-center">
                <a href="<?php echo e(url('/menu')); ?>"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Tambah Produk
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cafe6\resources\views/cart.blade.php ENDPATH**/ ?>