<?php

namespace App\Orchid\Resources;

use App\Models\Product;
use App\Models\User;
use Orchid\Crud\Resource;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ShoppingCartResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ShoppingCart::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('user')
                ->render(function ($model) {
                    $user = User::find($model->user_id);
                    return $user->name;
                }),
            TD::make('user mail')
                ->render(function ($model) {
                    $user = User::find($model->user_id);
                    return $user->email;
                }),
            TD::make('cart products')
                ->render(function ($model) {
                    $renderedImages = '<div style="display: grid; grid-template-columns: repeat(5, 1fr); place-items: center;">';
                    $counter = 0;

                    foreach ($model->cartProducts as $cartProduct) {
                        $renderedImages .= "<img width='100px' height='auto' style='object-fit: contain; aspect-ratio: 1;' src='{$cartProduct->product->images[0]->image}' alt='{$cartProduct->product->images[0]->alt}' />";
                        $counter++;
                        if ($counter >= 4) {
                            $extraProductsNumber = count($model->cartProducts) - 4;
                            $renderedImages .= "<p style='opacity: 50%;'>+{$extraProductsNumber}</p>";
                            $renderedImages .= '<p style="grid-column: 1 / 6; opacity: 50%;">To see all items check the cart detail.</p>';
                            break;
                        }
                    }

                    $renderedImages .= '</div>';

                    return $renderedImages;
                }),
            TD::make('total price')
                ->render(fn($model) => $model->totalPrice().'$'),
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
            Sight::make('user')
                ->render(function ($model) {
                    $user = User::find($model->user_id);
                    return $user->name;
                }),
            Sight::make('user mail')
                ->render(function ($model) {
                    $user = User::find($model->user_id);
                    return $user->email;
                }),
            Sight::make('cart products')
            ->render(function ($model) {
                $renderedImages = '<div style="display: flex; flex-wrap: wrap; gap: 20px;">';

                foreach ($model->cartProducts as $cartProduct) {
                    $renderedImages .= "
                    <div style='display: flex; flex-direction: column; gap: 10px;'>
                        <img width='100%' height='auto' style='max-width: 200px; object-fit: contain; aspect-ratio: 1;' src='{$cartProduct->product->images[0]->image}' alt='{$cartProduct->product->images[0]->alt}' />
                        <p style='margin: 0; opacity: 60%;'>{$cartProduct->quantity} unit(s)</p>
                        <p style='margin: 0; opacity: 60%;'>{$cartProduct->getSizeName()} size</p>
                    </div>
                    ";
                }

                $renderedImages .= '</div>';

                return $renderedImages;
            }),
            Sight::make('total price')
                ->render(fn($model) => $model->totalPrice().'$'),
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
