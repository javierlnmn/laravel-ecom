<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('components.base.footer', function ($view) {
            $footerCategories = ProductCategory::all()->take(5);
            $view->with('footerCategories', $footerCategories);
        });
    }
}
