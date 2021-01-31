<?php

namespace App\Roles;

use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Role;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
final class CustomerRole extends AbstractRole
{
    public static function role(): Role
    {
        return self::$role ?? self::$role = Jetstream::findRole('customer');
    }
}