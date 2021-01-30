<?php

namespace Models\Basket\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Models\Basket\CustomerBasket;
use Models\Basket\Exceptions\ProductNotFoundException;
use Models\Basket\Repositories\BasketRepository;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class CustomerCheckoutController extends Controller
{
    public function checkout(CustomerBasket $customerBasket): Response
    {
        try {
            $customerBasket->checkout();

            return response([
                'message' => 'Checkout completed.'
            ]);
        } catch (ProductNotFoundException $exception) {
            return response([
                'message' => 'There is no product in the basket.',
            ], 404);
        }
    }
}
