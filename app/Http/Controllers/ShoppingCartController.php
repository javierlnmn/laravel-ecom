<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartProduct;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{

    public function show()
    {
        $userCart = ShoppingCart::firstOrCreate(['user_id' =>  request()->user()->id]);
        return view('cart.user-cart', compact('userCart'));
    }

    public function store(Request $request, $productId)
    {
        $validatedData = $request->validate([
            'product-units' => 'required|numeric',
            'product-size' => 'required|string|max:255',
        ]);

        $productUnits = $validatedData['product-units'];
        $productSize = $validatedData['product-size'];

        $productStock = ProductStock::where('product_id', $productId)
            ->where('size_id', $productSize)
            ->whereColumn('quantity', '>', $productUnits)
            ->first();

        if (!$productStock)
        {
            return redirect()->back()->withErrors(['message' => 'The product size combination does not exist.'])->withInput();
        }

        $userCart = ShoppingCart::firstOrCreate(['user_id' =>  request()->user()->id]);

        $product = Product::find($productStock->product_id);

        ShoppingCartProduct::create([
            'shopping_cart_id' => $userCart->id,
            'product_id' => $product->id,
            'size_id' => $productSize,
            'quantity' => $productUnits,
            'price' => $product->price,
        ]);

        return redirect()->route('cart.show');
    }

    public function delete($cartProductId)
    {
        ShoppingCartProduct::find($cartProductId)->delete();
        return redirect()->route('cart.show');
    }
}
