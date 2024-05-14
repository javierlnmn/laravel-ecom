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

}
