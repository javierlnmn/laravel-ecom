<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProductStock extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $table = 'product_stock';

    public function save(array $options = [])
    {
        if (!is_null($this->getKey())) {
            return parent::save($options);
        }

        $existingStock = static::where('product_id', $this->product_id)
            ->where('size_id', $this->size_id)
            ->first();

        if ($existingStock) {
            $existingStock->increment('quantity', $this->quantity);
            return;
        }

        parent::save($options);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
