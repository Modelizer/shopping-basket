<?php

namespace Models\Basket\ValueObjects;

use Models\Basket\Entities\BasketItem;
use Symfony\Component\String\Exception\InvalidArgumentException;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class BasketItemFilterObject
{
    public function __construct(protected ?string $itemStatus)
    {
        if ($itemStatus && ! in_array($this->itemStatus, [BasketItem::IN_CART, BasketItem::REMOVED])) {
            throw new InvalidArgumentException;
        }
    }

    public function getItemStatus():? string
    {
        return $this->itemStatus;
    }
}
