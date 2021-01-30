<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Models\Basket\CustomerBasket;
use Tests\TestCase;

class StoreBasketItemTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->actAsCustomer();
    }

    public function test_basket_response_after_adding_item()
    {
        $product = Product::factory()->create();

        $response = $this->post("/api/customer/basket/{$product->id}/store");

        $response->assertStatus(200);
    }

    public function test_basket_response_when_bogus_item_given()
    {
        $response = $this->post("/api/customer/basket/product-id-does-not-exists/store");

        $response->assertStatus(404);
    }


    public function test_basket_response_when_same_product_is_added()
    {
        $customerBucket = new CustomerBasket($this->user);
        $customerBucket->addItem($product = Product::factory()->create());
        $response = $this->post("/api/customer/basket/{$product->id}/store");

        $response->dump()->assertStatus(200);
        $this->assertEquals(2, $response->json('data.items.0.quantity'));
    }
}
