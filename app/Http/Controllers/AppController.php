<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AppController extends Controller
{

    public function home()
    {
        // Untuk produk rekomendasi
        $recommendedProducts = Product::where('is_recommended', true)
                                    ->orWhere('featured', true)
                                    ->limit(3)
                                    ->get();
        
        // Untuk daftar produk reguler
        $products = Product::latest()->take(8)->get(); // Ambil 8 produk terbaru
        
        return view('home', compact('recommendedProducts', 'products'));
    }

    // ... method lainnya
}