<?php

namespace Models\Basket\Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class MarketeerProcessBasketItemTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->actAsMarketeer();
    }

    
}
