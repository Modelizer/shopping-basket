<?php

namespace Models\Basket\Aggregator;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Models\Basket\ValueObjects\BasketItemFilterObject;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class SearchBasketItemsAggregator
{
    protected array $basketItemFilters = [];

    public function __construct(private User $user)
    {
        //
    }

    public function get(BasketItemFilterObject $basketItemFilterObject): Collection
    {
        if ($basketItemFilterObject->getItemStatus()) {
            $this->basketItemFilters[] = ['status', $basketItemFilterObject->getItemStatus()];
        }

        return $this->user
            ->isCustomer()
            ->with([
                'baskets.items' => function ($item) {
                    $item->where($this->basketItemFilters);
                },
            ])
            ->get(['id', 'name']);
    }
}
