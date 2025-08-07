<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Pest\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // Jika pengguna tidak ditemukan, buat pengguna baru
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // Password acak
                ]);
            }

            // Login pengguna
            Auth::login($user);

            // Redirect ke halaman home
            return redirect()->route('home')->with('success', 'Login successful!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong!');
        }
    }
}