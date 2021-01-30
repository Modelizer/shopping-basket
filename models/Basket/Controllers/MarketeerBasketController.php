<?php

namespace Models\Basket\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Models\Basket\Aggregator\SearchBasketItemsAggregator;
use Models\Basket\Entities\Basket;
use Models\Basket\ValueObjects\BasketItemFilterObject;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class MarketeerBasketController extends Controller
{
    /**
     * Please note: Authentication of knowing user has sales role will be done by the middleware.
     * For now I skipped it.
     *
     * @param Request $request
     * @param Basket $basket
     * @return mixed
     */
    public function lists(Request $request, Basket $basket)
    {
        $aggregator = new SearchBasketItemsAggregator($basket);

        return $aggregator->get(new BasketItemFilterObject(itemStatus: $request->itemStatus));
    }
}
