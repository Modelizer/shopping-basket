<?php

namespace App\Roles;

use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Role;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
abstract class AbstractRole
{
    abstract public static function key(): string;

    public static function role(): Role
    {
        return Jetstream::findRole(static::key());
    }

    public static function permissions(): array
    {
        return static::role()->permissions;
    }
}
