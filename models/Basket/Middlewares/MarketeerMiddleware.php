<?php

namespace Models\Basket\Middlewares;

use App\Roles\MarketeerRole;
use Illuminate\Http\Request;

/**
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
