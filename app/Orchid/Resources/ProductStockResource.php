<?php

namespace App\Orchid\Resources;

use App\Models\Product;
use App\Models\Size;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ProductStockResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ProductStock::class;

    public static function label(): string
    {
        return 'Product Stock';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Select::make('product_id')
                ->fromModel(Product::class, 'name')
                ->title('Product')
                ->placeholder('Product')
                ->required(),
            Select::make('size_id')
                ->fromModel(Size::class, 'name')
                ->title('Size')
                ->placeholder('Size')
                ->required(),
            Input::make('quantity')
                ->title('Quantity')
                ->placeholder('Quantity')
                ->type('number'),
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
            TD::make('product images')
                ->render(function ($model) {
                    $product = Product::find($model->product_id);
                    $images = $product->images;

                    $renderedImages = '';

                    foreach ($images as $image) {
                        $renderedImages .= "<img width='100px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$image->image}' alt='{$image->alt}' />";
                    }

                    return $renderedImages;
                }),
            TD::make('size')
                ->sort()
                ->render(function ($model) {
                    $size = Size::find($model->size_id)->name;
                    return $size;
                }),
            TD::make('quantity'),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('product')
                ->render(function($model) {
                    $productName = Product::find($model->product_id)->name;
                    return $productName;
                }),
            Sight::make('product images')
                ->render(function ($model) {
                    $product = Product::find($model->product_id);
                    $images = $product->images;

                    $renderedImages = '';

                    foreach ($images as $image) {
                        $renderedImages .= "<img width='100px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$image->image}' alt='{$image->alt}' />";
                    }

                    return $renderedImages;
                }),
            Sight::make('size')
                ->render(function($model) {
                    $size = Size::find($model->size_id)->name;
                    return $size;
                }),
            Sight::make('quantity'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
}
