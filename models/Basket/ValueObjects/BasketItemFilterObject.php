<?php

namespace Models\Basket\ValueObjects;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class BasketItemFilterObject
{
    public function __construct(public $itemStatus)
    {
        //
    }
}
