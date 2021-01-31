<?php

namespace Models\Basket;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Models\Basket\Middlewares\CustomerMiddleware;
use Models\Basket\Middlewares\MarketeerMiddleware;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class BasketServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api/customer/basket')
                ->middleware(['api', 'auth:sanctum', CustomerMiddleware::class])
                ->namespace('Models\\Controller')
                ->name('customer.bucket.')
                ->group(base_path('models/Basket/Routes/customer.php'));

            Route::prefix('api/marketeer/basket')
                ->middleware(['api', 'auth:sanctum', MarketeerMiddleware::class])
                ->namespace('Models\\Controller')
                ->name('marketeer.bucket.')
                ->group(base_path('models/Basket/Routes/marketeer.php'));
        });

        $this->loadMigrationsFrom(base_path('models/Basket/Migrations'));

        // @todo factories should also load from the model's directory. Unfortunately the bug is still not solved in
        // Laravel.
    }
}
