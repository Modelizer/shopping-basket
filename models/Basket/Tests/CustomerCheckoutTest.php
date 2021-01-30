<?php

namespace Models\Basket\Tests;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Models\Basket\CustomerBasket;
use Tests\TestCase;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class CustomerCheckoutTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->actAsCustomer();
    }

    public function test_customer_checkout_with_an_item()
    {
        $customerBasket = new CustomerBasket($this->user);
        $customerBasket->addItem(Product::factory()->create());

        $response = $this->post("/api/customer/basket/checkout");

        $response->assertStatus(200);
    }

    public function test_customer_should_fail_to_checkout_when_no_item_in_the_basket()
    {
        $response = $this->post("/api/customer/basket/checkout");

        $response->assertStatus(404);
    }
}
