<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil produk rekomendasi untuk Home
        $recommendedProducts = Product::where('is_recommended', true)->get();

        // Ambil semua produk untuk Menu
        $products = Product::all();

        return view('home', compact('recommendedProducts', 'products'));
    }
}
