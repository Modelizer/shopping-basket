<?php

namespace Models\Basket\Middlewares;

use App\Models\User;
use App\Roles\MarketeerRole;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Models\Basket\CustomerBasket;
use Models\Basket\Entities\BasketItem;
use Models\Basket\Scopes\SkipCustomerRemovedItemScope;

/**
 * Customer middleware will enforce all the customer's logic in the application.
 *
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class MarketeerMiddleware
{
    public function handle(Request $request, callable $next)
    {
        if (! $request->user()->tokenCan(MarketeerRole::key())) {
            abort(401);
        }

        return $next($request);
    }
}
