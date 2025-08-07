<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Kosmeta @yield('title')</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .nav-link {
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: -4px;
        left: 0;
        background-color: #2563eb;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
    }

    .mobile-menu {
        transform: translateY(-100%);
        transition: transform 0.3s ease-in-out;
        visibility: hidden;
    }

    .mobile-menu.active {
        transform: translateY(0);
        visibility: visible;
    }

    .menu-overlay {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .menu-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    html {
        scroll-behavior: smooth;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
    </style>
</head>

<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-blue-100">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2 group z-50">
                    <span class="sr-only">Kosmeta</span>
                    <div class="relative">
                        <span
                            class="text-3xl font-bold bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent group-hover:scale-105 transition-transform duration-300 font-serif italic">
                            Kosmeta
                        </span>
                        <span
                            class="absolute -bottom-1 left-0 w-full h-1.5 bg-gradient-to-r from-blue-200 to-blue-100 rounded-full opacity-80 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex justify-center flex-grow">
                    <ul class="flex items-center space-x-1">
                        <li>
                            <a href="/"
                                class="nav-link px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 relative group">
                                Beranda
                                <span
                                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#about"
                                class="nav-link px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 relative group">
                                Tentang
                                <span
                                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#menu"
                                class="nav-link px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 relative group">
                                Menu
                                <span
                                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#gallery"
                                class="nav-link px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 relative group">
                                Galeri
                                <span
                                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#contact"
                                class="nav-link px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 relative group">
                                Kontak
                                <span
                                    class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-3/4 group-hover:left-1/4"></span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    @auth
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-700 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if(isset($cartCount) && $cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">

                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-150">
                                    <svg class="h-5 w-5 mr-3 text-red-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <!-- Authentication Buttons -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 text-blue-700 font-medium rounded-full hover:bg-blue-50 transition-all duration-300 border border-blue-200 hover:border-blue-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-medium rounded-full hover:from-blue-700 hover:to-blue-600 transition-all duration-300 shadow-sm hover:shadow-md">
                        Daftar
                    </a>
                </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="menuButton"
                    class="md:hidden flex items-center justify-center w-10 h-10 text-gray-700 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-colors duration-300 focus:outline-none z-50">
                    <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="md:hidden hidden absolute top-20 inset-x-0 bg-white shadow-lg py-3 px-6 border-t border-gray-100 z-40">
            <div class="flex flex-col space-y-4">
                <a href="/"
                    class="nav-link py-3 px-4 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 border-b border-gray-100 hover:bg-blue-50 rounded-lg">Beranda</a>
                <a href="#about"
                    class="nav-link py-3 px-4 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 border-b border-gray-100 hover:bg-blue-50 rounded-lg">Tentang</a>
                <a href="#menu"
                    class="nav-link py-3 px-4 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 border-b border-gray-100 hover:bg-blue-50 rounded-lg">Menu</a>
                <a href="#gallery"
                    class="nav-link py-3 px-4 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 border-b border-gray-100 hover:bg-blue-50 rounded-lg">Galeri</a>
                <a href="#contact"
                    class="nav-link py-3 px-4 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 border-b border-gray-100 hover:bg-blue-50 rounded-lg">Kontak</a>

                @auth
                <!-- Cart Link for Mobile -->
                <a href="{{ route('cart.index') }}"
                    class="flex items-center py-3 px-4 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300 border-b border-gray-100 hover:bg-blue-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Keranjang
                    @if(isset($cartCount) && $cartCount > 0)
                    <span
                        class="ml-auto bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>

                <form action="{{ route('logout') }}" method="POST" class="w-full pt-4 border-t border-gray-200">
                    @csrf
                    <button type="submit"
                        class="w-full py-3 text-center text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-colors duration-300 border border-blue-200">
                        Keluar
                    </button>
                </form>
                @else
                <div class="flex flex-col space-y-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('login') }}"
                        class="py-3 text-center text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-colors duration-300 border border-blue-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="py-3 text-center bg-gradient-to-r from-blue-600 to-blue-500 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-300">
                        Daftar
                    </a>
                </div>
                @endauth
            </div>
        </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow fade-in">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-white to-blue-50 border-t border-blue-100 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <!-- Brand Info -->
                <div class="space-y-5">
                    <div class="flex items-center">
                        <span class="text-3xl font-serif italic font-bold text-blue-700">Kosmeta</span>
                        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">SMKN 6
                            Jember</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Kantin sekolah SMKN 6 Jember yang menyediakan berbagai makanan dan minuman sehat untuk siswa dan
                        guru.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-6 uppercase tracking-wider">Menu <span
                            style="color: #2563eb;">Cepat</span></h3>
                    <ul class="space-y-3">
                        <li><a href="#beranda"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Beranda</a></li>
                        <li><a href="#about"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Tentang</a></li>
                        <li><a href="#menu"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Menu</a></li>
                        <li><a href="#gallery"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Galeri</a></li>
                        <li><a href="#contact"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-300 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-6 uppercase tracking-wider">Hubungi <span
                            style="color: #2563eb;">kami</span></h3>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mt-0.5 mr-3 text-blue-600 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>SMKN 6 Jember<br>RCVP+R39, Jl. PB.Sudirman, Tekoan, Tanggul Kulon, Kec. Tanggul,
                                Kabupaten Jember, Jawa Timur 68155</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            kosmeta@smkn6jember.sch.id
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            (0331) 123456
                        </li>
                    </ul>
                </div>

                <!-- Opening Hours -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-6 uppercase tracking-wider">Jam <span
                            style="color: #2563eb;">Buka</span></h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex justify-between">
                            <span class="font-medium">Senin - Jumat</span>
                            <span>07:00 - 15:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="font-medium">Sabtu</span>
                            <span>08:00 - 12:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="font-medium">Minggu</span>
                            <span>Tutup</span>
                        </li>
                        <li class="pt-4 mt-4 border-t border-gray-200">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-blue-500 mr-2 animate-pulse"></div>
                                <span class="text-blue-600 font-medium">Saat Ini Buka</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright & Legal -->
            <div class="border-t border-gray-200 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-500 text-sm mb-4 md:mb-0">
                        &copy; {{ date('Y') }} Kosmeta SMKN 6 Jember. Hak cipta dilindungi.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#"
                            class="text-gray-500 hover:text-blue-600 text-sm transition-colors duration-300">Kebijakan
                            Privasi</a>
                        <a href="#"
                            class="text-gray-500 hover:text-blue-600 text-sm transition-colors duration-300">Syarat &
                            Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        let isMenuOpen = false;

        function toggleMenu() {
            isMenuOpen = !isMenuOpen;
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            mobileMenu.classList.toggle('hidden');
            document.body.style.overflow = isMenuOpen ? 'hidden' : '';
        }

        menuButton.addEventListener('click', toggleMenu);

        const header = document.querySelector('header');
        window.addEventListener('scroll', () => {
            header.classList.toggle('shadow-md', window.scrollY > 0);
        });
    });
    </script>
</body>

</html>