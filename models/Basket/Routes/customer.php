<?php

use Illuminate\Support\Facades\Route;
use Models\Basket\Controllers\CustomerBasketItemController;
use Models\Basket\Controllers\CustomerCheckoutController;

Route::post('checkout', [CustomerCheckoutController::class, 'checkout'])->name('checkout');
Route::post('{product}/store', [CustomerBasketItemController::class, 'store'])->name('item.store');
Route::post('{product}/remove', [CustomerBasketItemController::class, 'remove'])->name('item.remove');
