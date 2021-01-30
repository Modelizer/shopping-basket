<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Models\Basket\Entities\Basket;

class BasketFactory extends Factory
{
    protected $model = Basket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
        ];
    }

    public function orderCompleted()
    {
        return [
            'order' => Basket::ORDER_COMPLETED,
        ];
    }
}
