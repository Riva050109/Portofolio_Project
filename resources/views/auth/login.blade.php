<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">


            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Card -->
            <div
                class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden backdrop-blur-sm backdrop-filter bg-opacity-90 dark:bg-opacity-90">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Welcome users</h2>
                    <p class="mt-1 text-indigo-100">Please log in to your account first</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="p-6 space-y-6">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email')"
                            class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="block w-full pl-10 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 rounded-md transition duration-200"
                                type="email" name="email" :value="old('email')" required autofocus autocomplete="email"
                                placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')"
                            class="mt-1 text-red-600 dark:text-red-400 text-sm" />
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                            @if (Route::has('password.request'))
                            <a class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition duration-150 ease-in-out"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                            @endif
                        </div>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="block w-full pl-10 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 rounded-md transition duration-200"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')"
                            class="mt-1 text-red-600 dark:text-red-400 text-sm" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="h-4 w-4 border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded transition duration-200"
                            name="remember">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <x-primary-button
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Sign in') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Social Login Section -->
                <div class="px-6 pb-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                Or continue with
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <!-- Facebook -->
                        <a href="#"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <!-- Google -->
                        <a href="{{ route('login.google') }}"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                <path fill="currentColor"
                                    d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                            </svg>
                        </a>

                        <!-- GitHub -->
                        <a href="#"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition duration-200">
                    Sign up
                </a>
                <!-- Admin Access Link -->
                <div class="text-center text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Admin access?
                    <a href="{{ url('/admin/login') }}" {{-- Ubah sesuai path login AdminPanelProvider kamu --}}
                        class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition duration-200">
                        log in Admin
                    </a>
                </div>
            </div>

        </div>
</x-guest-layout>