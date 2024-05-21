<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brandsBanner = Brand::get();
        $brands = Brand::orderBy('name')->paginate(8);
        return view('brands.brand-index', compact('brands', 'brandsBanner'));
    }

    public function show($brandSlug)
    {
        $brand = Brand::findBySlug($brandSlug);

        $brandProducts = $brand->products()->paginate(8);

        return view('brands.brand-detail', compact('brand', 'brandProducts'));
    }

}
