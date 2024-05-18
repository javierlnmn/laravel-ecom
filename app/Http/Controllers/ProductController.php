<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->paginate(8);

        return view('products.product-index', compact('products'));
    }

    public function show($productSlug)
    {
        $product = Product::findBySlug($productSlug);

        return view('products.product-detail', compact('product'));

    }

}
