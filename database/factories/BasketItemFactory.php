<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Models\Basket\Entities\Basket;
use Models\Basket\Entities\BasketItem;

class BasketItemFactory extends Factory
{
    protected $model = BasketItem::class;

    public function definition()
    {
        return [
            'basket_id' => Basket::factory(),
            'product_id' => Product::factory(),
            'status' => BasketItem::IN_CART,
        ];
    }

    public function removedItem()
    {
        return [
            'status' => BasketItem::REMOVED,
        ];
    }
}
