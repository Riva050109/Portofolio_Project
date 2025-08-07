<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Transaction;

class BalanceController extends Controller
{
    /**
     * Show the top-up form.
     */
    public function show()
    {
        return view('balance.topup');
    }

    /**
     * Process the top-up request and generate a verification code.
     */
    public function requestTopup(Request $request)
    {
        // Validate the amount input
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:10000', // Minimal top-up Rp10,000
        ]);

        $user = Auth::user();

        // Generate a random verification code (6 characters)
        $verificationCode = Str::random(6); // Example: ABC123

        // Save the verification code to the database
        $user->update(['verification_code' => $verificationCode]);

        // Store the top-up amount in the session temporarily
        session(['topup_amount' => $validatedData['amount']]);

        // Redirect to the verification page with the code displayed
        return redirect()->route('balance.verify')->with('info', "Your verification code is: {$verificationCode}. Please enter it to complete the top-up.");
    }

    /**
     * Show the verification code form.
     */
    public function verify()
    {
        return view('balance.verify');
    }

    /**
     * Confirm the top-up after verifying the code.
     */
    public function confirmTopup(Request $request)
{
    $validatedData = $request->validate([
        'code' => 'required|string|max:6', // Verification code must be 6 characters
    ]);

    $user = Auth::user();

    // Check if the entered code matches the stored verification code
    if ($user->verification_code !== $validatedData['code']) {
        return redirect()->route('balance.verify')->with('error', 'Invalid verification code.');
    }

    // Retrieve the top-up amount from the session
    $amount = session('topup_amount');

    // Validate the amount to ensure it's within acceptable limits
    if ($amount > 9999999999.99) { // Batas maksimal untuk DECIMAL(15, 2)
        return redirect()->route('balance.verify')->with('error', 'Top-up amount exceeds the maximum limit.');
    }

    // Add the top-up amount to the user's balance
    $user->increment('balance', $amount);

    // Save the transaction to the database
    $transaction = new Transaction();
    $transaction->user_id = $user->id;
    $transaction->type = 'top-up';
    $transaction->amount = $amount;
    $transaction->save();

    // Clear the verification code and session data
    $user->update(['verification_code' => null]);
    session()->forget('topup_amount');

    // Redirect to the dashboard with a success message
    return redirect()->route('dashboard')->with('success', 'Top-up successful! Your new balance is Rp' . number_format($user->balance + $amount, 2));
}
}
