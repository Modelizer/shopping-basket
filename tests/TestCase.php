<?php

namespace Tests;

use App\Models\User;
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
            ['customer']
        );
    }

    protected function actAsMarketeer()
    {
        Sanctum::actingAs(
            $this->user = User::factory()->create(),
            ['marketeer']
        );
    }

    protected function getCustomerBasket()
    {
        return new CustomerBasket($this->user ??= User::factory()->create());
    }
}
