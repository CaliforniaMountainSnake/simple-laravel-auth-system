<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;

trait MustHasUser
{
    /**
     * @return AuthUserEntity|null
     */
    abstract public function getUserEntity(): ?AuthUserEntity;
}
