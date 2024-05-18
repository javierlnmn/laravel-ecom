<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Sluggable;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

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
        return $this->hasMany(Product::class, 'brand_id')->orderBy('created_at', 'DESC');
    }

}
