<?php

namespace Models\Basket\Aggregator;

use Models\Basket\ValueObjects\BasketItemFilterObject;
use Models\Basket\Entities\Basket;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class SearchBasketItemsAggregator
{
    protected array $itemFilters = [];

    public function __construct(private Basket $basket)
    {
        //
    }

    public function get(BasketItemFilterObject $basketItemFilterObject)
    {
        if ($basketItemFilterObject->itemStatus) {
            $this->itemFilters[] = ['status', $basketItemFilterObject->itemStatus];
        }

        $this->basket->with(['items' => function ($item) {
            $item->where($this->itemFilters);
        }]);

        return $this->basket->get();
    }
}
