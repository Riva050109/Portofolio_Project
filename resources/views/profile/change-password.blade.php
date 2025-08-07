@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Change Password</h1>
    <form method="POST" action="{{ route('password.update') }}" class="max-w-lg mx-auto">
        @csrf
        <div class="mb-4">
            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" name="current_password" id="current_password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Update Password
        </button>
    </form>
</div>
@endsection