<?php

namespace Models\Basket\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class ProductNotFoundException extends \Exception
{
    #[Pure] public function __construct(string $message = 'Product not found.')
    {
        parent::__construct($message, 404);
    }
}
