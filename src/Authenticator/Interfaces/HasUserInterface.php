<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;

/**
 * Helps to create objects that contains a User.
 */
interface HasUserInterface
{
    /**
     * Get the authenticated user.
     *
     * @return AuthUserEntity|null Authenticated user or null.
     */
    public function getUserEntity(): ?AuthUserEntity;
}
