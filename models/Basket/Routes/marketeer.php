<?php

use Illuminate\Support\Facades\Route;
use Models\Basket\Controllers\MarketeerBasketController;

Route::get('/users', [MarketeerBasketController::class, 'users'])->name('users');
