<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Show the transfer form.
     */
    
    public function showTransferForm()
    {
        return view('transactions.transfer');
    }

    /**
     * Process the money transfer.
     */
    public function processTransfer(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'recipient_email' => 'required|email|exists:users,email', // Email penerima harus ada di database
            'amount' => 'required|numeric|min:1000', // Minimal transfer Rp1,000
        ]);

        // Ambil pengguna yang sedang login (pengirim)
        $sender = Auth::user();

        // Cari penerima berdasarkan email
        $recipient = User::where('email', $validatedData['recipient_email'])->first();

        // Periksa saldo pengirim
        if ($sender->balance < $validatedData['amount']) {
            return redirect()->route('transfer.form')->with('error', 'Insufficient balance.');
        }

        // Kurangi saldo pengirim
        $sender->decrement('balance', $validatedData['amount']);

        // Tambah saldo penerima
        $recipient->increment('balance', $validatedData['amount']);

        // Simpan transaksi untuk pengirim
        $senderTransaction = new Transaction();
        $senderTransaction->user_id = $sender->id;
        $senderTransaction->type = 'transfer';
        $senderTransaction->amount = $validatedData['amount'];
        $senderTransaction->save();

        // Simpan transaksi untuk penerima
        $recipientTransaction = new Transaction();
        $recipientTransaction->user_id = $recipient->id;
        $recipientTransaction->type = 'receive';
        $recipientTransaction->amount = $validatedData['amount'];
        $recipientTransaction->save();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Transfer successful!');
    }

    /**
     * Show the transaction history for the authenticated user.
     */
    public function showHistory()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil semua transaksi pengguna, diurutkan dari yang terbaru
        $transactions = $user->transactions()->latest()->get();

        // Tampilkan halaman riwayat transaksi
        return view('transactions.history', compact('transactions'));
    }
}
