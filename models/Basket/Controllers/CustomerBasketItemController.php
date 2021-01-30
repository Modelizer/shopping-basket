<?php

namespace Models\Basket\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Response;
use Models\Basket\CustomerBasket;
use Models\Basket\Exceptions\ProductNotFoundException;
use Throwable;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class CustomerBasketItemController extends Controller
{
    public function lists(CustomerBasket $customerBasket): Response
    {
        return response([
            'data' => $customerBasket->getBasket()->toArray(),
        ]);
    }

    public function store(Product $product, CustomerBasket $customerBasket): Response
    {
        try {
            $customerBasket->addItem($product);

            return response([
                'message' => 'Successfully added the product to the basket.',

                // Note: The purpose of sending entire basket help frontend developers to replace the entire state
                // of the basket. This prevent cherry picking to update changed records.
                // It also helps to dynamically change any attributes of products got updated in the background.
                'data' => $customerBasket->getBasket()->toArray(),
            ]);
        } catch (Throwable $exception) {
            // Right now no exception is thrown. Ignoring for now.
        }
    }

    public function remove(Product $product, CustomerBasket $basketObject): Response
    {
        try {
            $basketObject->removeItem($product);

            return response([
                'message' => 'Successfully deleted the product from the basket.',
                'data' => $basketObject->getBasket()->toArray(),
            ]);
        } catch (ProductNotFoundException $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 404);
        }
    }
}
