<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-white to-blue-50 py-6 sm:py-12">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div
            class="absolute top-0 left-1/4 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 right-1/4 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute bottom-0 left-1/3 w-64 h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
        </div>
    </div>

    <div class="container mx-auto px-4 py-6 sm:py-12 relative">
        <!-- Hero Section -->
        <section id="home" class="relative mb-20 sm:mb-32 text-center py-12 sm:py-20">
            <div class="relative inline-block mb-8 sm:mb-12">
                <span
                    class="absolute -inset-1 bg-gradient-to-r from-blue-200 to-blue-100 blur-xl opacity-30 animate-pulse"></span>
                <h1 class="relative text-5xl sm:text-7xl md:text-8xl font-black text-gray-900 animate-fadeIn">
                    Selamat Datang di
                    <span class="text-blue-700 relative inline-block font-serif italic">
                        Toko Kosmeta
                        <div
                            class="absolute -bottom-2 left-0 w-full h-3 bg-blue-200 -z-10 transform -rotate-1 animate-wiggle">
                        </div>
                    </span>
                </h1>
            </div>
            <p
                class="text-xl sm:text-3xl text-gray-700 mb-12 sm:mb-16 leading-relaxed max-w-3xl mx-auto px-4 font-light animate-fadeInUp">
                SMKN 6 Jember - Tempat belanja kebutuhan berkualitas anda
            </p>
            <div class="flex justify-center gap-6">
                <a href="#menu"
                    class="group inline-flex items-center bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 sm:px-12 py-4 sm:py-5 rounded-full font-bold hover:from-blue-700 hover:to-blue-600 transform hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-2xl text-lg sm:text-xl">
                    Lihat Produk
                    <svg class="ml-3 w-6 h-6 group-hover:translate-x-2 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="#contact"
                    class="group inline-flex items-center bg-white text-blue-600 px-8 sm:px-12 py-4 sm:py-5 rounded-full font-bold hover:bg-blue-50 transform hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-2xl text-lg sm:text-xl border-2 border-blue-600">
                    Hubungi Kami
                    <svg class="ml-3 w-6 h-6 group-hover:translate-x-2 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </a>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="mb-20 sm:mb-32">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Produk <span
                        style="color: #2563eb;">Rekomendasi</span></h2>
                <p class="text-lg text-gray-600">Temukan koleksi terbaik kami</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $recommendedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative overflow-hidden rounded-2xl shadow-lg">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                    <img src="<?php echo e(Storage::url($product->image)); ?>" alt="<?php echo e($product->name); ?>"
                        class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-20">
                        <h3 class="text-2xl font-bold text-white mb-2"><?php echo e($product->name); ?></h3>
                        <p class="text-white/90"><?php echo e($product->description); ?></p>
                        <p class="text-blue-400 font-bold mt-2">Rp<?php echo e(number_format($product->price, 0)); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- Menu Section -->
        <section id="menu" class="mb-20 sm:mb-32">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Menu <span
                        style="color: #2563eb;">Kami</span>
                </h2>
                <p class="text-lg text-gray-600">Temukan produk berkualitas kami</p>
            </div>

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
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">
                    <!-- Product Image -->
                    <div class="h-48 overflow-hidden flex-shrink-0">
                        <?php if($product->image): ?>
                        <img src="<?php echo e(asset('storage/'.$product->image)); ?>" alt="<?php echo e($product->name); ?>"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                        <?php else: ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Details -->
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo e($product->name); ?></h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2 flex-grow"><?php echo e($product->description); ?></p>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="text-blue-600 font-bold text-lg">Rp<?php echo e(number_format($product->price, 0)); ?></p>
                            <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="flex items-center">
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
                    <p class="text-gray-500 text-lg">Produk tidak tersedia</p>
                </div>
                <?php endif; ?>
            </section>
        </section>


        <!-- Bagian Galeri -->
        <section id="gallery" class="py-20 bg-white mb-32 sm:mb-48">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Galeri <span
                            style="color: #2563eb;">Kami</span></h2>
                    <p class="text-lg text-gray-600">Suasana Toko Kosmeta SMKN 6 Jember</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-4">
                    <!-- Item Galeri 1 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/p1.jpg" alt="Interior Toko"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>

                    <!-- Item Galeri 2 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/p2.jpg" alt="Produk Kosmetik"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>

                    <!-- Item Galeri 3 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/p3.jpg" alt="Display Produk"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>

                    <!-- Item Galeri 4 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/p4.jpg" alt="Pelayanan"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>

                    <!-- Item Galeri 5 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/V5.jpg" alt="Area Toko"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>
                    <!-- Item Galeri 5 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/V6.jpg" alt="Area Toko"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>
                    <!-- Item Galeri 5 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/V7.jpg" alt="Area Toko"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-medium text-sm sm:text-base"></span>
                        </div>
                    </div>

                    <!-- Item Galeri 6 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="/imager/V8.jpg" alt="Acara Khusus"
                            class="w-full h-48 sm:h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <spa class="text-white font-medium text-sm sm:text-base"> </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="mb-12 sm:mb-80">
            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-8 relative">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3">Tentang <span
                            style="color: #2563eb;">Kami</span></h2>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                        Toko Kosmeta merupakan sebuah proyek digital inovatif yang dikembangkan oleh para siswa SMKN 6
                        Jember, khususnya dari jurusan Rekayasa Perangkat Lunak (RPL) dan Multimedia. Proyek ini hadir
                        sebagai bagian dari kegiatan pembelajaran berbasis praktik, yang bertujuan untuk mengasah
                        kemampuan siswa dalam merancang, mengelola, dan mempromosikan platform digital secara
                        profesional. Melalui Toko Kosmeta, kami memasarkan berbagai produk unggulan seperti makanan
                        kemasan buatan siswa serta peralatan sekolah yang berkualitas. Platform ini tidak hanya menjadi
                        wadah promosi, tetapi juga media belajar nyata bagi siswa untuk memahami proses bisnis digital,
                        pengembangan web, desain visual, dan strategi pemasaran online. Dengan demikian, Toko Kosmeta
                        diharapkan dapat menjadi contoh nyata penerapan ilmu di dunia industri dan kewirausahaan digital
                        sejak bangku sekolah.


                    </p>
                </div>
            </div>
        </section>
        <!-- Contact Section -->
        <section id="contact" class="mb-20 sm:mb-32">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Hubungi <span
                            style="color: #2563eb;">Kami</span></h2>
                    <p class="text-lg text-gray-600">Kami siap membantu Anda</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600">SMKN 6 Jember, Jawa Timur</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-600">tokokosmeta@smkn6jember.sch.id</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-600">(0331) 123456</span>
                            </div>
                        </div>
                    </div>

                    <?php if(session('success')): ?>
                    <div id="notification" x-data="{ show: true }"
                        x-init="setTimeout(() => { show = false; setTimeout(() => document.getElementById('notification').remove(), 200); }, 10000)"
                        x-show="show" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4"
                        class="fixed bottom-6 right-6 bg-blue-500 text-white px-5 py-3 rounded-xl shadow-xl flex items-center z-[9999] max-w-md gap-3">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div class="flex-1">
                            <p class="font-medium">Berhasil!</p>
                            <p class="text-sm text-blue-100"><?php echo e(session('success')); ?></p>
                        </div>
                        <button
                            onclick="document.getElementById('notification').style.opacity = '0'; setTimeout(() => document.getElementById('notification').remove(), 200)"
                            class="flex-shrink-0 focus:outline-none hover:bg-blue-600 rounded-full p-1 transition-colors"
                            aria-label="Tutup notifikasi">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <?php endif; ?>

                    <form class="bg-white rounded-xl shadow-lg p-6" method="POST" action="<?php echo e(route('saran.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Pelanggan</label>
                            <input name="nama_pelanggan"
                                class="form-input w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500"
                                type="text" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                            <input name="email"
                                class="form-input w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500"
                                type="email">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Isi Pesan
                                anda</label>
                            <textarea name="isi_saran"
                                class="form-textarea w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500"
                                rows="4" required></textarea>
                        </div>
                        <input type="hidden" name="tanggal_saran" value="<?php echo e(now()); ?>">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-full transition-colors duration-300">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
/* Animations */
@keyframes blob {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    25% {
        transform: translate(20px, -20px) scale(1.1);
    }

    50% {
        transform: translate(-20px, 20px) scale(0.9);
    }

    75% {
        transform: translate(20px, 20px) scale(1.1);
    }
}

@keyframes wiggle {

    0%,
    100% {
        transform: rotate(-1deg);
    }

    50% {
        transform: rotate(1deg);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
    scroll-padding-top: 80px;
}

section[id] {
    scroll-margin-top: 80px;
}

/* Navigation */
.nav-link {
    @apply text-gray-700 hover: text-blue-600 font-medium transition-colors duration-300;
}

/* Buttons */
.menu-filter-btn {
    @apply px-6 py-2 rounded-full font-medium transition-all duration-300 hover: bg-blue-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2;
}

.menu-filter-btn.active {
    @apply bg-blue-600 text-white;
}

.add-to-cart-btn {
    @apply inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-full hover: bg-blue-700 transition-colors duration-300 text-sm font-medium;
}

/* Form Inputs */
.form-input {
    @apply w-full px-3 py-2 border border-gray-300 rounded-md focus: outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent;
}

.form-textarea {
    @apply w-full px-3 py-2 border border-gray-300 rounded-md focus: outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-none;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js" defer></script>

<script>
// Smooth scroll with offset for fixed navbar
document.addEventListener('DOMContentLoaded', function() {
    // Handle anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            // Skip if href is just #
            if (this.getAttribute('href') === '#') return;

            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                const offset = 80; // Adjust based on your navbar height
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Update URL without reload
                if (history.pushState) {
                    history.pushState(null, null, targetId);
                } else {
                    window.location.hash = targetId;
                }
            }
        });
    });

    // If there's a hash in URL on page load, scroll to the element
    if (window.location.hash) {
        setTimeout(() => {
            const target = document.querySelector(window.location.hash);
            if (target) {
                const offset = 80;
                const targetPosition = target.getBoundingClientRect().top;
                const offsetPosition = targetPosition + window.pageYOffset - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }, 100);
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cafe6\resources\views/home.blade.php ENDPATH**/ ?>