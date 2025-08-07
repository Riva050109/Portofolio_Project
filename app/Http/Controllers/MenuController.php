<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all(); // Ambil semua produk dari database
        $category = $request->query('category');
        $products = $category
            ? Product::where('category', $category)->get()
            : Product::all();

        return view('menu', compact('products'));
    }

   

    
}