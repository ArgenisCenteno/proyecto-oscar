<?php

namespace App\Providers;

use App\Models\BcvRate;
use App\Models\CartItem;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartCount = CartItem::where('user_id', auth()->id())->count();
            } else {
                $cart = session()->get('cart', []);
                $cartCount = is_array($cart) ? count($cart) : 0;
            }

            $view->with('cartCount', $cartCount);
        });

        View::composer('*', function ($view) {
            if (auth()->check()) {
                $tasa = BcvRate::latest()->first();
                $dollar = $tasa ? $tasa->precio : 270.60;
            } else {
                 $dollar = 270.60;
                 
            }

            $view->with('dollar', $dollar);
        });
    }
}
