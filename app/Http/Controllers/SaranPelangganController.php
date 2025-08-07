<?php
namespace App\Http\Controllers;

use App\Models\SaranPelanggan;
use Illuminate\Http\Request;

class SaranPelangganController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'isi_saran' => 'required|string|max:1000',
            'tanggal_saran' => 'required|date'
        ]);

        SaranPelanggan::create($validated);

        return back()->with('success', 'Terima kasih atas sarannya!');
    }
}