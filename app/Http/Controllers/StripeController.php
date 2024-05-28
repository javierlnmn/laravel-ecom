<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment() {

        $validatedData = request()->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'address_additional' => 'string|max:255',
            'postal_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $stripeSecretKey = config('stripe.secret_key');
        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $userCart = ShoppingCart::firstOrCreate(['user_id' =>  request()->user()->id]);
        $cartProducts = $userCart->cartProducts;
        $totalPrice = 0;
        $lineItems = [];

        foreach($cartProducts as $cartProduct) {
            $totalPrice += $cartProduct->product->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data'=> [
                        'name' => $cartProduct->product->name.', size '.$cartProduct->getSizeName(),
                    ],
                    'unit_amount' => $cartProduct->product->price*100,
                ],
                'quantity' => $cartProduct->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        $newOrder = Order::create([
            'user_id' => request()->user()->id,
            'total_price' => $totalPrice,
            'session_id' => $session->id,
        ]);

        foreach($cartProducts as $cartProduct) {
            OrderProduct::create([
                'order_id' => $newOrder->id,
                'product_id' => $cartProduct->product->id,
                'price' => $cartProduct->product->price,
                'size_id' => $cartProduct->size_id,
                'quantity' => $cartProduct->quantity,
            ]);
        }

        $userCart->emptyCart();

        return redirect($session->url);

    }

    public function success()
    {
        $stripeSecretKey = config('stripe.secret_key');
        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $sessionId = request()->get('session_id');

        if (!$sessionId) {
            return abort(404);
        }

        try {

            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if (!$session) {
                return abort(404);
            }

            $order = Order::where('session_id', $session->id)
                ->where('status', 'payment_pending')
                ->first();

            if (!$order) {
                return abort(404);
            }

            $order->status = 'processing_order';
            $order->save();

        } catch(\Exception $e) {
            return abort(404);
        }

        return view('payments.success');
    }

    public function cancel()
    {
        return view('payments.cancel');
    }
}
