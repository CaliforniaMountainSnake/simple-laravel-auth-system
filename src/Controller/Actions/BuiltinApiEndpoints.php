<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller\Actions;

trait BuiltinApiEndpoints
{
    /**
     * @return string
     */
    public static function AVAILABLE_ROUTES(): string
    {
        return 'available_routes';
    }

    /**
     * @return string
     */
    public static function AVAILABLE_ACTIONS(): string
    {
        return 'available_actions';
    }
}
