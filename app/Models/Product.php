<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Sluggable;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function priceWithDiscount()
    {
        if ($this->discount <= 0) return $this->price;
        $finalPrice = number_format($this->price - ($this->price * $this->discount / 100), 2, '.', ',');
        return $finalPrice;
    }

    public function stock()
    {
        $stock = $this->hasMany(ProductStock::class);
        return $stock;
    }

    public function getTotalStock()
    {
        return $this->stock()->sum('quantity');
    }

    public function getProductStock()
    {
        return ProductStock::find();
    }

}
