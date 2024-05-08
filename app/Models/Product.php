<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'brand_id',
        'price',
        'discount',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

}
