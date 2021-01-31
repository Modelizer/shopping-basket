<?php

namespace Models\Basket\Tests;

use App\Models\Product;
use App\Models\User;
use App\Roles\CustomerRole;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Jetstream\Jetstream;
use Models\Basket\CustomerBasket;
use Models\Basket\Entities\BasketItem;
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

    public function test_lists_all_users_and_their_basket_items()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->createToken(CustomerRole::key(), CustomerRole::permissions());
        $customerBasket = new CustomerBasket($user);
        $customerBasket->addItem(Product::factory()->create())
            ->addItem($product = Product::factory()->create())
            ->removeItem($product);

        $response = $this->get('/api/marketeer/basket/users');

        $response->assertStatus(200);
        $this->assertEquals(BasketItem::IN_CART, $response->json('data.0.baskets.0.items.0.status'));
        $this->assertEquals(BasketItem::REMOVED, $response->json('data.0.baskets.0.items.1.status'));
    }
}
