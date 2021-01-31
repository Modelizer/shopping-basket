<?php

namespace Models\Basket\Tests;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class RemoveBasketItemTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->actAsCustomer();
    }

    public function test_customer_remove_item_from_basket()
    {
        $this->getCustomerBasket()->addItem(Product::factory()->create());
        $this->getCustomerBasket()->addItem($product = Product::factory()->create());

        $response = $this->post("/api/customer/basket/{$product->id}/remove");

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data.items');
    }

    public function test_fails_when_item_is_not_present_inside_the_basket()
    {
        $response = $this->post("/api/customer/basket/bogus-product-id/remove");

        $response->assertStatus(404);
    }
}
