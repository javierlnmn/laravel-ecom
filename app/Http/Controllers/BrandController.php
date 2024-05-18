<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::get();
        return view('brands.brand-index', compact('brands'));
    }

    public function show($brandSlug)
    {
        $brand = Brand::findBySlug($brandSlug);

        return view('brands.brand-detail', compact('brand'));
    }

}
