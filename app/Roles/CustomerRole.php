<?php

namespace App\Roles;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
final class CustomerRole extends AbstractRole
{
    public static function key(): string
    {
        return 'customer';
    }
}
