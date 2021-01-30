<?php

namespace Models\Basket\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Models\Basket\Entities\BasketItem;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class SkipCustomerRemovedItemScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('status', BasketItem::IN_CART);
    }
}
