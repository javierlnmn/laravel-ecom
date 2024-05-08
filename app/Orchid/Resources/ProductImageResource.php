<?php

namespace App\Orchid\Resources;

use App\Models\Product;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;

class ProductImageResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ProductImage::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Picture::make('image')
                ->title("Product Images")
                ->placeholder("Product Images")
                ->required(),
            Input::make('alt')
                ->title("Product Image Alernative Text")
                ->placeholder("Product Image Alernative Text")
                ->required(),
            Select::make('product_id')
                ->fromModel(Product::class, 'name')
                ->title('Product')
                ->placeholder('Product')
                ->required(),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('product')
                ->sort()
                ->render(function ($model) {
                    $productName = Product::find($model->product_id)->name;
                    return $productName;
                }),

            TD::make('image')
                ->render(function($model) {
                    return "<img width='100px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$model->image}' alt='{$model->alt}' />";
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            new DefaultSorted('product_id', 'desc'),
        ];
    }
}
