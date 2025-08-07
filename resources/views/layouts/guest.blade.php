<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    /* Custom transitions */
    .page-transition {
        transition: background-color 0.3s ease-in-out;
    }

    /* Custom animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased transition-colors duration-300 ease-in-out">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 page-transition">
        <div class="fade-in">
            <a href="/" class="group">
                <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500 transition-colors duration-300 group-hover:text-gray-700 dark:group-hover:text-gray-300" /> -->
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden sm:rounded-lg backdrop-blur-sm bg-opacity-95 dark:bg-opacity-95 fade-in">
            <div class="relative z-10">
                {{ $slot }}
            </div>

            <!-- Optional decorative elements -->
            <div
                class="absolute top-0 right-0 -mt-6 -mr-6 w-24 h-24 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full blur-xl">
            </div>
            <div
                class="absolute bottom-0 left-0 -mb-6 -ml-6 w-24 h-24 bg-gradient-to-tr from-pink-500/20 to-orange-500/20 rounded-full blur-xl">
            </div>
        </div>
    </div>

    <!-- Optional background patterns -->
    <div class="fixed inset-0 -z-10 bg-white dark:bg-gray-900" aria-hidden="true">
        <div
            class="absolute inset-0 bg-grid-gray-100/20 dark:bg-grid-gray-800/20 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
    </div>
</body>

</html>