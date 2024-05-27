<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ShoppingCartProduct extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $fillable = [
        'shopping_cart_id',
        'product_id',
        'size_id',
        'quantity',
    ];

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getSizeName()
    {
        return $this->size ? $this->size->name : null;
    }

}
