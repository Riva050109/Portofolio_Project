@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800">Settings</h1>
    <p class="text-gray-600 mt-4">Manage your account preferences here.</p>
</div>
<!-- Success/Error Messages -->
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('settings.update') }}" method="POST" class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    @csrf
    @method('POST')

    <!-- Name -->
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
    </div>

    <!-- Current Password -->
    <div class="mb-4">
        <label for="current_password" class="block text-gray-700 font-bold mb-2">Current Password</label>
        <input type="password" name="current_password" id="current_password"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <p class="text-sm text-gray-600 mt-1">Leave blank if you don't want to change your password.</p>
    </div>

    <!-- New Password -->
    <div class="mb-4">
        <label for="new_password" class="block text-gray-700 font-bold mb-2">New Password</label>
        <input type="password" name="new_password" id="new_password"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <!-- Confirm New Password -->
    <div class="mb-4">
        <label for="new_password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <!-- Submit Button -->
    <button type="submit"
        class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors duration-300">
        Save Changes
    </button>
</form>
</div>
@endsection