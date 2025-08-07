@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Profile</h1>
    <form method="POST" action="{{ route('profile.update') }}" class="max-w-lg mx-auto">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Save Changes
        </button>
    </form>
</div>
@endsection