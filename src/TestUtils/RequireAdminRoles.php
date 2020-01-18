<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\TestUtils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;

trait RequireAdminRoles
{
    /**
     * @return AuthUserRoleEnum[]
     */
    abstract public function getAdminRoles(): array;
}
