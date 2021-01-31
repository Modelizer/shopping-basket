<?php

namespace App\Roles;

use Laravel\Jetstream\Role;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
abstract class AbstractRole
{
    protected static ?Role $role;

    abstract public static function role(): Role;

    public static function key(): string
    {
        return static::role()->key;
    }

    public static function permissions(): array
    {
        return static::role()->permissions;
    }
}
