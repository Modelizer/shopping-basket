<?php

namespace Models\Basket\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class BasketItem extends Model
{
    public const IN_CART = 'IN_CART';
    public const REMOVED = 'REMOVED';

    protected $guarded = ['id'];
}
