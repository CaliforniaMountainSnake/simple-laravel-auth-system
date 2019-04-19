<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums;

use MyCLabs\Enum\Enum;

/**
 * Тип аккаунта - платный, бесплатный.
 * Или же по тарифам - тариф1, тариф2, и т.п.
 */
abstract class AuthUserAccountTypeEnum extends Enum
{
    /**
     * Бесплатный аккаунт.
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
