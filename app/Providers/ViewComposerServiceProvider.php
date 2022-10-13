<?php

namespace App\Providers;

use Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
class ViewComposerServiceProvider extends ServiceProvider
{
    // use Cart;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.partials.nav', function ($view) {
            $data=  $view->with('categories', Category::orderByRaw('name ASC')->get()->nest());
        });

        View::composer('site.partials.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
    }
}
