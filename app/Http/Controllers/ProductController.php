<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // The read phrase, usually its SELECT * FROM products 
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
