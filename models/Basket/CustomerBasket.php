<?php

namespace Models\Basket;

use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Models\Basket\Entities\Basket;
use Models\Basket\Entities\BasketItem;
use Models\Basket\Exceptions\ProductNotFoundException;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class CustomerBasket
{
    protected Basket|Model|Builder $basket;

    public function __construct(protected Authenticatable $user)
    {
        $this->basket = $this->user
            ->baskets()
            ->where('order', Basket::ORDER_PENDING)
            ->with('items')
            ->firstOrCreate();
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }

    public function addItem(Product $product): self
    {
        $basketItem = $this->basket
            ->items()
            ->firstOrNew([
                'product_id' => $product->id,
            ]);

        if ($basketItem->id) {
            $basketItem->quantity = $basketItem->quantity + 1;
        }

        $this->basket->items()->save($basketItem);
        $this->basket->refresh();

        return $this;
    }

    /**
     * @param Product $product
     * @return $this
     * @throws ProductNotFoundException
     */
    public function removeItem(Product $product): self
    {
        try {
            $basketItem = $this->basket
                ->items()
                ->where('product_id', $product->id)
                ->firstOrFail()
                ->fill([
                    'status' => BasketItem::REMOVED,
                ]);

            $this->basket->items()->save($basketItem);
        } catch (ModelNotFoundException $exception) {
            throw new ProductNotFoundException;
        }

        $this->basket->refresh();

        return $this;
    }

    /**
     * @return Basket
     * @throws ProductNotFoundException
     */
    public function checkout(): Basket
    {
        if (! $this->basket->items->count()) {
            throw new ProductNotFoundException;
        }

        $this->basket->update([
            'order' => Basket::ORDER_COMPLETED,
        ]);

        return $this->basket;
    }
}
