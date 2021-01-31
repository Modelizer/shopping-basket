<?php

namespace Tests;

use App\Models\User;
use App\Roles\CustomerRole;
use App\Roles\MarketeerRole;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use Models\Basket\CustomerBasket;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected ?User $user;

    protected function actAsCustomer()
    {
        Sanctum::actingAs(
            $this->user = User::factory()->create(),
            CustomerRole::permissions(),
        );
    }

    protected function actAsMarketeer()
    {
        Sanctum::actingAs(
            $this->user = User::factory()->create(),
            MarketeerRole::permissions(),
        );
    }

    protected function getCustomerBasket()
    {
        return new CustomerBasket($this->user ??= User::factory()->create());
    }
}
