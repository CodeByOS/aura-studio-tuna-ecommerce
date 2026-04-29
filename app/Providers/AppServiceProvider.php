<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Services\CartService;

class AppServiceProvider extends ServiceProvider
{



    /**
     * Register any application services.
     */
    public function register(): void
    {   
    }

    /**
     * Bootstrap any application services.
     */

    
    public function boot(CartService $cartService): void
    {   

    
        View::composer('layouts.app' , function($view) use ($cartService){
            $count = $cartService->count();
            $view->with('cartCount', $count);
        }) ; 

    }
}
