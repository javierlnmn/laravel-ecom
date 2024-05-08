<?php

namespace App\Orchid\Resources;

use Illuminate\Support\Str;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class BrandResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Brand::class;

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
            Picture::make('image')
                ->title("Brand's image")
                ->placeholder("Brand's image"),

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

            // TD::make('description')
            //     ->render(function($model) {
            //         return Str::words($model->description, '5');
            //     }),
            TD::make('description')
                ->render(function($model) {
                    return Str::words($model->description, '5');
                }),

            TD::make('image')
                ->render(function($model) {
                    return "<img width='40px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$model->image}' alt='{$model->name}' />";
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
            Sight::make('description')
                ->render(function($model) {
                    if (!$model->description) {
                        return '<span style="opacity: 50%;">No description provided.</span>';
                    }
                    return $model->description;
                }),
            Sight::make('image')
                ->render(function($model) {
                    return "<img width='40px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$model->image}' alt='{$model->name}' />";
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
