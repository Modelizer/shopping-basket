<?php

namespace Models\Basket\Middlewares;

use App\Roles\CustomerRole;
use Illuminate\Http\Request;
use Models\Basket\CustomerBasket;
use Models\Basket\Entities\BasketItem;
use Models\Basket\Scopes\SkipCustomerRemovedItemScope;

/**
 * Customer middleware will enforce all the customer's logic in the application.
 *
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class CustomerMiddleware
{
    public function handle(Request $request, callable $next)
    {
        if (! $request->user()->tokenCan(CustomerRole::key())) {
            abort(401);
        }

        // Preventing removed items from the CustomerBasket object.
        BasketItem::addGlobalScope(new SkipCustomerRemovedItemScope);

        // Making sure we always get the same customer's basket
        app()->singleton(CustomerBasket::class, function () use ($request) {
            return new CustomerBasket($request->user());
        });

        return $next($request);
    }
}
