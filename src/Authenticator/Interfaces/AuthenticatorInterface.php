<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Exceptions\AuthenticationException;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;

/**
 * Interface that allows object to create an authenticated user from any sources.
 */
interface AuthenticatorInterface extends HasUserInterface
{
    /**
     * Create an authenticated user from anywhere.
     * (For example, from HTTP query).
     *
     * @return AuthUserEntity|null The instance of authenticated user or null if not-auth users are allowed.
     * @throws AuthenticationException
     */
    public function authenticateUser(): ?AuthUserEntity;
}
