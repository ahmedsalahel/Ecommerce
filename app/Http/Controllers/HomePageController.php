<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        $productPrice = Product::orderBy('price', 'desc')->take(4)->get();
        $productLatest = Product::orderBy('created_at', 'desc')->take(4)->get();
        $productOldest = Product::orderBy('created_at', 'asc')->take(4)->get();
        return view('front.index', compact('categories', 'products', 'productPrice', 'productLatest', 'productOldest'));
    }
}
