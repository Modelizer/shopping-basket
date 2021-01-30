<?php

namespace Models\Basket\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Basket extends Model
{
    use HasFactory;

    public const ORDER_PENDING = 'PENDING';
    public const ORDER_COMPLETED = 'COMPLETED';

    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(BasketItem::class);
    }
}
