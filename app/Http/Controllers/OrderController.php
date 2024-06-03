<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\UserAddress;

class OrderController extends Controller
{
    public function checkout() {
        $userCart = ShoppingCart::firstOrCreate(['user_id' =>  request()->user()->id]);

        if(count($userCart->cartProducts) <= 0) {
            return redirect()->route('cart.show')->withErrors(['message' => 'Add items to your cart to make an order.']);
        }

        $userAddresses = UserAddress::where('user_id', request()->user()->id)->get();

        return view('orders.checkout', compact('userCart', 'userAddresses'));
    }

    public function index()
    {
        $userOrders = Order::where('user_id', request()->user()->id)->paginate(6);
        return view('orders.index', compact('userOrders'));
    }

    public function destroy(Order $orderId)
    {
        $order = Order::find($orderId)->first();
        if($order->status != 'payment_pending') {
            return redirect()->route('order.index')->withErrors(['message' => "You can't delete an order that is in course. Please contact us in order to do so."]);
        }
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Payment pending order cancelled!');
    }
}
