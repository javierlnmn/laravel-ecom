<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model
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

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->orderBy('created_at', 'DESC');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function parentList()
    {
        if (!$this->parent_id) return [$this];
        return array_merge($this->parent->parentList(), [$this]);
    }

    public function allProducts()
    {
        $products = $this->products;

        foreach ($this->children as $childCategory) {
            $products = $products->merge($childCategory->allProducts());
        }

        return $products;
    }

}
