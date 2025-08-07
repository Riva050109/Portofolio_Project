<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the user settings form.
     */
    public function showSettings()
    {
        $user = Auth::user();
        return view('settings', compact('user'));
    }

    /**
     * Update the user's settings.
     */
    public function updateSettings(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Perbarui nama dan email
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Perbarui password jika ada
        if ($request->filled('current_password') && Hash::check($validatedData['current_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($validatedData['new_password']),
            ]);
        } elseif ($request->filled('current_password')) {
            return redirect()->route('settings')->with('error', 'Current password is incorrect.');
        }

        // Redirect dengan pesan sukses
        return redirect()->route('settings')->with('success', 'Settings updated successfully!');
    }
}
