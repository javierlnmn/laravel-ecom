<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Size extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_stock')->withPivot('quantity')->withTimestamps();
    }
}
