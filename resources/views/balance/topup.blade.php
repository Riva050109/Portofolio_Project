@extends('layouts.app')
@section('content')

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-lg">
        <div class="md:flex">
            <div class="p-8 w-full">
                <div class="uppercase tracking-wide text-2xl font-bold text-indigo-600 mb-8">
                    Top-Up Balance
                </div>

                <form method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">
                            Amount (IDR)
                        </label>
                        <div class="mt-1">
                            <input type="number" name="amount" id="amount" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            Request Top-Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
