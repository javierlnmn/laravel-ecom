<?php

namespace App\Orchid\Resources;

use App\Models\ProductCategory;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ProductCategoryResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ProductCategory::class;

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
            Select::make('parent_id')
                ->required(false)
                ->fromModel(ProductCategory::class, 'name')
                ->title('Parent Category')
                ->empty('No parent category')
                ->placeholder('Parent Category'),
            TextArea::make('description')
                ->title('Description')
                ->placeholder("Description"),
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
            TD::make('name'),
            TD::make('slug')
                ->render(fn($model) => "www.example.com/categories/<b>{$model->slug}</b>"),
            TD::make('parent')
                ->render(function($model) {
                    if (!$model->parent_id) return '<span style="opacity: 50%;">No parent category.</span>';
                    $parentName = ProductCategory::find($model->parent_id)->name;
                    return $parentName;
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
                ->render(fn($model) => "www.example.com/categories/<b>{$model->slug}</b>"),
            Sight::make('description')
                ->render(function($model) {
                    if (!$model->description) {
                        return '<span style="opacity: 50%;">No description provided.</span>';
                    }
                    return $model->description;
                }),
            Sight::make('parent')
                ->render(function($model) {
                    if (!$model->parent_id) return '<span style="opacity: 50%;">No parent category.</span>';
                    $parentName = ProductCategory::find($model->parent_id)->name;
                    return $parentName;
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
