<?php

namespace App\Orchid\Resources;

use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Sight;

class ProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Name')
                ->placeholder("Name")
                ->required(),
            TextArea::make('description')
                ->title('Description')
                ->placeholder("Description"),
            Input::make('sku')
                ->title('Sku')
                ->placeholder('Sku')
                ->popover('Product Identifier Code')
                ->required(),
            Select::make('category_id')
                ->fromModel(ProductCategory::class, 'name')
                ->title('Category')
                ->placeholder('Category')
                ->required(),
            Select::make('brand_id')
                ->fromModel(Brand::class, 'name')
                ->title('Brand')
                ->placeholder('Brand')
                ->required(),
            Group::make([
                Input::make('price')
                    ->title('Price')
                    ->type('float')
                    ->mask([
                        'alias' => 'currency',
                    ])
                    ->placeholder('Price')
                    ->required(),
                Input::make('discount')
                    ->title('Discount')
                    ->type('float')
                    ->mask([
                        'alias' => 'currency',
                    ])
                    ->placeholder('Discount')
                    ->required(),
            ]),
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
            TD::make('sku'),

            TD::make('name')
                ->render(function($model) {
                    return Str::words($model->name, '5');
                }),
            
            TD::make('slug')
                ->render(fn($model) => "www.example.com/products/<b>{$model->slug}</b>"),

            TD::make('description')
                ->render(function($model) {
                    return Str::words($model->description, '5');
                }),

            TD::make('category')
                ->render(function($model) {
                    $categoryName = ProductCategory::find($model->category_id)->name;
                    return $categoryName;
                }),

            TD::make('brand')
                ->render(function($model) {
                    $brandName = Brand::find($model->brand_id)->name;
                    return $brandName;
                }),

            TD::make('price')
                ->render(fn($model) => "{$model->price}$"),

            TD::make('images')
                ->render(function ($model) {
                    $product = Product::find($model->id);
                    $images = $product->images;

                    $renderedImages = '';

                    foreach ($images as $image) {
                        $renderedImages .= "<img width='40px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$image->image}' alt='{$image->alt}' />";
                    }

                    return $renderedImages;
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
        return [
            Sight::make('name'),
        
            Sight::make('slug')
                ->render(fn($model) => "www.example.com/products/<b>{$model->slug}</b>"),

            Sight::make('description')
                ->render(function($model) {
                    if (!$model->description) {
                        return '<span style="opacity: 50%;">No description provided.</span>';
                    }
                    return $model->description;
                }),

            Sight::make('sku'),

            Sight::make('category')
                ->render(function($model) {
                    $categoryName = ProductCategory::find($model->category_id)->name;
                    return $categoryName;
                }),

            Sight::make('brand')
                ->render(function($model) {
                    $brandName = Brand::find($model->brand_id)->name;
                    return $brandName;
                }),

            Sight::make('price')->render(fn($model) => "{$model->price}$"),

            Sight::make('discount')->render(fn($model) => "{$model->discount}%"),

            Sight::make('price after discount')
                ->render(function($model) {
                    if ($model->discount <= 0) return $model->price."$";
                    $discount = ($model->price * ($model->discount / 100));
                    $finalPrice = $model->price - $discount;
                    return $finalPrice."$";
                }),

            Sight::make('product images')
                ->render(function ($model) {
                    $product = Product::find($model->id);
                    $images = $product->images;

                    $renderedImages = '';

                    foreach ($images as $image) {
                        $renderedImages .= "<img width='150px' height='auto' style='object-fit: contain; aspect-ratio: 1; margin-right: 10px;' src='{$image->image}' alt='{$image->alt}' />";
                    }

                    $renderedImages .= '<p style="opacity: 50%; margin-top: 20px;">To add more images, go to Product Images CRUD.</p>';

                    return $renderedImages;
                }),
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
