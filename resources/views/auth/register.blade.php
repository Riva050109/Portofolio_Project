<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-purple-50 to-pink-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 py-12 px-4 sm:px-6 lg:px-8">
        <div
            class="max-w-md w-full bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8 transform transition-all duration-300 hover:shadow-2xl">
            <div class="text-center">
                <h2
                    class="text-4xl font-bold text-gray-900 dark:text-white bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                    Create Your Account
                </h2>
                <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-200">
                        Sign in here
                    </a>
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Name -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input id="name"
                        class="block w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 group-hover:shadow-md"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Your Name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <!-- Email Address -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-text-input id="email"
                        class="block w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 group-hover:shadow-md"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Your Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <!-- Password -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password"
                        class="block w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 group-hover:shadow-md"
                        type="password" name="password" required autocomplete="new-password"
                        placeholder="Your Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <!-- Confirm Password -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation"
                        class="block w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300 group-hover:shadow-md"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm Password" />
                    <x-input-error :messages="$errors->get('password_confirmation')"
                        class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105 active:scale-95 font-semibold">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">
                By registering, you agree to our
                <a href="#"
                    class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-200">
                    Terms of Service
                </a> and
                <a href="#"
                    class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-200">
                    Privacy Policy
                </a>.
            </div>
        </div>
    </div>
</x-guest-layout>