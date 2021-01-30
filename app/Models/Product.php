<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
