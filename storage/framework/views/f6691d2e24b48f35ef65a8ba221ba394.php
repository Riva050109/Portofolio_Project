<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Menu <span style="color: #2563eb;">Kami</span>
        </h2>

        <!-- Filter by Category -->
        <div class="mb-8 flex justify-center">
            <div class="inline-flex rounded-md shadow-sm">
                <a href="<?php echo e(route('menu')); ?>"
                    class="px-4 py-2 text-sm font-medium rounded-l-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                    Semua
                </a>
                <a href="<?php echo e(route('menu', ['category' => 'food'])); ?>"
                    class="px-4 py-2 text-sm font-medium border-t border-b border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                    Makanan
                </a>
                <a href="<?php echo e(route('menu', ['category' => 'drink'])); ?>"
                    class="px-4 py-2 text-sm font-medium rounded-r-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                    Minuman
                </a>
            </div>
        </div>

        <!-- Product List -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                <!-- Product Image -->
                <div class="h-48 overflow-hidden flex-shrink-0">
                    <?php if($product->image): ?>
                    <img src="<?php echo e(asset('storage/'.$product->image)); ?>" alt="<?php echo e($product->name); ?>"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    <?php else: ?>
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Tidak Ada Gambar</span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Product Details -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo e($product->name); ?></h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?php echo e($product->description); ?></p>
                    <div class="flex items-center justify-between mt-auto pt-3">
                        <p class="text-blue-600 font-bold text-lg whitespace-nowrap">
                            Rp<?php echo e(number_format($product->price, 0)); ?></p>
                        <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="flex-shrink-0">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300 whitespace-nowrap">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada produk tersedia</p>
            </div>
            <?php endif; ?>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cafe6\resources\views/menu.blade.php ENDPATH**/ ?>