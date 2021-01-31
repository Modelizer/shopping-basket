<?php

namespace Models\Basket\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Models\Basket\Aggregator\SearchBasketItemsAggregator;
use Models\Basket\Entities\Basket;
use Models\Basket\ValueObjects\BasketItemFilterObject;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class MarketeerBasketController extends Controller
{
    public function users(Request $request, SearchBasketItemsAggregator $aggregator): Response
    {
        $filter = new BasketItemFilterObject(itemStatus: $request->get('itemStatus'));

        return response([
            'data' => $aggregator->get($filter)->toArray(),
        ]);
    }
}
