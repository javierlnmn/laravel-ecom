<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout() {
        $userCart = ShoppingCart::firstOrCreate(['user_id' =>  request()->user()->id]);
        if(count($userCart->cartProducts) <= 0) {
            return redirect()->route('cart.show')->withErrors(['message' => 'Add items to your cart to make an order.'])->withInput();
        }
        return view('orders.checkout', compact('userCart'));
    }
}
