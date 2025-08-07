<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaranPelanggan extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'email',
        'tanggal_saran',
        'isi_saran'
    ];
    
    protected $casts = [
        'tanggal_saran' => 'datetime'
    ];
}