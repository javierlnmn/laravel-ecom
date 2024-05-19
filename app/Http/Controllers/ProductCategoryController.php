<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with(['products' => function ($query) {
            $query->limit(4);
        }])->paginate(5);
        return view('categories.category-index', compact('categories'));
    }

    public function show($categorySlug)
    {
        $category = ProductCategory::findBySlug($categorySlug);

        $categoryProducts = $category->allProducts();

        return view('categories.category-detail', compact('category', 'categoryProducts'));
    }

}
