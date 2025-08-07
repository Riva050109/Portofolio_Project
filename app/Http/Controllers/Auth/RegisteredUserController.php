<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'], // Nama wajib diisi, bertipe string, maksimal 255 karakter
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class], // Email wajib, string, huruf kecil, format email, maks 255 karakter, unik di tabel User
        'password' => ['required', 'confirmed', Rules\Password::defaults()], // Kata sandi wajib, harus dikonfirmasi, sesuai aturan default
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Kata sandi dienkripsi
    ]);

    event(new Registered($user)); // Memicu event registrasi

    Auth::login($user); // Login pengguna
        return redirect(RouteServiceProvider::HOME);
    }
}