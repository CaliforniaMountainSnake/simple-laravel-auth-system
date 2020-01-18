<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces\AuthenticatorInterface;

trait MustHasAuthenticator
{
    /**
     * @return AuthenticatorInterface
     */
    abstract public function getAuthenticator(): AuthenticatorInterface;
}
