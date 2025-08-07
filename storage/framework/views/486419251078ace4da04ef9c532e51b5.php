

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Flash Messages -->
    <?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm border border-green-200">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg shadow-sm border border-red-200">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white shadow-md">
            <div class="flex flex-col md:flex-row items-center">
                <div class="flex-shrink-0 mb-4 md:mb-0">
                    <div
                        class="h-24 w-24 rounded-full bg-white flex items-center justify-center shadow-lg overflow-hidden">
                        <?php if(auth()->user()->profile_photo_path): ?>
                        <img src="<?php echo e(asset('storage/' . auth()->user()->profile_photo_path)); ?>" alt="Profile"
                            class="h-full w-full object-cover">
                        <?php else: ?>
                        <span class="text-3xl font-bold text-green-600">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="md:ml-6 text-center md:text-left">
                    <h1 class="text-2xl font-bold"><?php echo e(auth()->user()->name); ?></h1>
                    <p class="text-green-100"><?php echo e(auth()->user()->email); ?></p>
                    <p class="mt-2 text-green-100">Member since <?php echo e(auth()->user()->created_at->format('F Y')); ?></p>
                </div>
            </div>
        </div>

        <!-- Profile Navigation -->
        <div class="border-b border-gray-200" x-data="{ activeTab: 'overview' }">
            <nav class="flex flex-col sm:flex-row -mb-px">
                <button @click="activeTab = 'overview'"
                    class="ml-0 sm:ml-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                    :class="activeTab === 'overview' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                    Profile Overview
                </button>
                <button @click="activeTab = 'edit'"
                    class="ml-0 sm:ml-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                    :class="activeTab === 'edit' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                    Edit Profile
                </button>
                <button @click="activeTab = 'security'"
                    class="ml-0 sm:ml-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                    :class="activeTab === 'security' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                    Security
                </button>
                <button @click="activeTab = 'notifications'"
                    class="ml-0 sm:ml-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                    :class="activeTab === 'notifications' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                    Notifications
                </button>
            </nav>

            <!-- Profile Content -->
            <div class="p-6">
                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="bg-gray-50 p-6 rounded-lg" x-data="{ open: true }">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-800">Personal Information</h2>
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                                    <svg class="h-5 w-5" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>
                            <div x-show="open" x-transition class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Full Name</p>
                                    <p class="text-gray-800"><?php echo e(auth()->user()->name); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email Address</p>
                                    <p class="text-gray-800"><?php echo e(auth()->user()->email); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Account Status</p>
                                    <p class="font-medium"
                                        :class="auth()->user()->email_verified_at ? 'text-green-600' : 'text-red-600'">
                                        <?php echo e(auth()->user()->email_verified_at ? 'Verified' : 'Unverified'); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Statistics -->
                        <div class="bg-gray-50 p-6 rounded-lg" x-data="{ open: true }">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-800">Account Statistics</2>
                                    <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                                        <svg class="h-5 w-5" :class="{ 'rotate-180': open }" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                            </div>
                            <div x-show="open" x-transition class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Member Since</p>
                                    <p class="text-gray-800"><?php echo e(auth()->user()->created_at->format('F j, Y')); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Login</p>
                                    <p class="text-gray-800"><?php echo e(auth()->user()->last_login_at ?? 'N/A'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Account Type</p>
                                    <p class="text-gray-800"><?php echo e(auth()->user()->role ?? 'Standard User'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Tab (Placeholder) -->
                <div x-show="activeTab === 'edit'" x-transition>
                    <p class="text-gray-600">Edit profile form will be displayed here. <a
                            href="<?php echo e(route('profile.edit')); ?>" class="text-green-600 hover:underline">Go to Edit
                            Profile</a></p>
                </div>

                <!-- Security Tab (Placeholder) -->
                <div x-show="activeTab === 'security'" x-transition>
                    <p class="text-gray-600">Security settings (e.g., change password) will be displayed here. <a
                            href="<?php echo e(route('password.change')); ?>" class="text-green-600 hover:underline">Go to Change
                            Password</a></p>
                </div>

                <!-- Notifications Tab (Placeholder) -->
                <div x-show="activeTab === 'notifications'" x-transition>
                    <p class="text-gray-600">Notification preferences will be displayed here.</p>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="<?php echo e(route('profile.edit')); ?>"
                            class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-green-400 hover:bg-green-50 text-center transition-all duration-200 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <p class="mt-2 text-sm font-medium text-gray-700">Edit Profile</p>
                        </a>
                        <a href="<?php echo e(route('password.change')); ?>"
                            class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-green-400 hover:bg-green-50 text-center transition-all duration-200 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <p class="mt-2 text-sm font-medium text-gray-700">Change Password</p>
                        </a>
                        <a href="<?php echo e(route('settings')); ?>"
                            class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-green-400 hover:bg-green-50 text-center transition-all duration-200 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="mt-2 text-sm font-medium text-gray-700">Settings</p>
                        </a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:border-red-400 hover:bg-red-50 text-center transition-all duration-200 transform hover:scale-105 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-red-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <p class="mt-2 text-sm font-medium text-gray-700">Logout</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cafe6\resources\views/profile.blade.php ENDPATH**/ ?>