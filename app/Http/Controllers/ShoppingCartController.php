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

        $userCart = ShoppingCart::firstOrCreate(['user_id' =>  request()->user()->id]);

        $alreadyInCart = ShoppingCartProduct::where('shopping_cart_id', $userCart->id)
            ->where('product_id', $productId)
            ->where('size_id', $productSize)
            ->first();

        $productStock = ProductStock::where('product_id', $productId)
            ->where('size_id', $productSize)
            ->whereColumn('quantity', '>=', $productUnits)
            ->first();

        if (!$productStock)
        {
            return redirect()->back()->withErrors(['message' => 'There is not enough stock for this size.'])->withInput();
        }

        if ($alreadyInCart) {

            if ($productStock->quantity < $productUnits + $alreadyInCart->quantity)
            {
                return redirect()->back()->withErrors(['message' => 'There is not enough stock for this size.'])->withInput();
            }

            $alreadyInCart->quantity += $productUnits;
            $alreadyInCart->save();
        } else {
            $product = Product::find($productStock->product_id);

            ShoppingCartProduct::create([
                'shopping_cart_id' => $userCart->id,
                'product_id' => $product->id,
                'size_id' => $productSize,
                'quantity' => $productUnits,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'Item added to the cart!');
    }

    public function delete($cartProductId)
    {
        ShoppingCartProduct::find($cartProductId)->delete();
        return redirect()->route('cart.show')->withErrors(['message' => 'Product removed from your cart successfully :(']);
    }
}
