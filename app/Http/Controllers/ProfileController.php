<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class ProfileController extends Controller
{
    // Ensure only authenticated users can access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the profile page
    public function show()
    {
        return view('profile');
    }

    // Show the edit profile form
    public function edit()
    {
        return view('profile.edit');
    }

    // Update profile information
    public function update(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        try {
            // Update the authenticated user's information
            $user = Auth::user();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } catch (QueryException $e) {
            // Handle database errors (e.g., duplicate email despite validation)
            return back()->withErrors(['error' => 'Failed to update profile. Please try again.'])->withInput();
        }
    }

    // Show the change password form
    public function changePassword()
    {
        return view('profile.change-password');
    }

    // Update the user's password
    public function updatePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Update the authenticated user's password
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('profile')->with('success', 'Password updated successfully!');
        } catch (QueryException $e) {
            // Handle database errors
            return back()->withErrors(['error' => 'Failed to update password. Please try again.'])->withInput();
        }
    }
    public function settings()
    {
        return view('settings'); // Create a settings.blade.php view
    }
}