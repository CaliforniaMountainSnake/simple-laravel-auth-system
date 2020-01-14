<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces\AuthenticatorInterface;

/**
 * Trait helps to create objects that contain UserBuilder.
 */
trait HasAuthenticatorTrait
{
    /**
     * @var AuthenticatorInterface
     */
    protected $authenticator;

    /**
     * @return AuthenticatorInterface
     */
    public function getAuthenticator(): AuthenticatorInterface
    {
        return $this->authenticator;
    }
}
