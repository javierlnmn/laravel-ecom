<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {

        $query = Product::query();

        $searchBy = request()->input('searchBy');

        if ($searchBy) {
            $query->where('name', 'like', '%' . $searchBy . '%')
                ->orWhere('description', 'like', '%' . $searchBy . '%');
        }

        $orderBy = request()->input('orderBy', 'created_at;desc');
        $orderByParts = explode("-", $orderBy);

        if (count($orderByParts) == 2) {
            $orderByField = $orderByParts[0];
            $orderByOrder = $orderByParts[1];

            if (strcasecmp($orderByOrder, 'desc') != 0 && strcasecmp($orderByOrder, 'asc') != 0) {
                $products = $query->orderBy($orderByField, 'asc')->paginate(8);
            } else {
                $products = $query->orderBy($orderByField, $orderByOrder)->paginate(8);
            }

        } else {
            $products = $query->orderBy('created_at', 'desc')->paginate(8);
        }

        return view('products.product-index', compact('products'));
    }

    public function show($productSlug)
    {
        $product = Product::findBySlug($productSlug);

        return view('products.product-detail', compact('product'));

    }

}
