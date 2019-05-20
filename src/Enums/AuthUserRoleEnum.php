<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums;

use MyCLabs\Enum\Enum;

/**
 * Роль юзера - неавторизованный, пользователь, админ и т.п.
 */
class AuthUserRoleEnum extends Enum
{
    public const NOT_AUTH = 'not_auth';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    public static function NOT_AUTH(): self
    {
        return new static(static::NOT_AUTH);
    }
}
