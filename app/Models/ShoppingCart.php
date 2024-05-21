<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function cartProducts()
    {
        return $this->hasMany(ShoppingCartProduct::class);
    }

    public function totalPrice()
    {
        $cartProducts = $this->cartProducts;
        $finalPrice = 0;

        foreach ($cartProducts as $cartProduct)
        {
            $finalPrice += $cartProduct->product->priceWithDiscount() * $cartProduct->quantity;
        }

        if (floor($finalPrice) == $finalPrice) {
            return number_format($finalPrice, 0, '.', ',');
        } else {
            return number_format($finalPrice, 2, '.', ',');
        }
    }

}
