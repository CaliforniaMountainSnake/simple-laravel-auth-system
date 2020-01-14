<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums;

use MyCLabs\Enum\Enum;

/**
 * The account type - free, paid, etc.
 * Or by tariffs - tariff_1, tariff_2, etc.
 */
class AuthUserAccountTypeEnum extends Enum
{
    /**
     * Free account.
     */
    public const FREE = 'free';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    public static function FREE(): self
    {
        return new static (static::FREE);
    }
}
