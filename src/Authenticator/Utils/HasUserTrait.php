<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;

/**
 * Trait helps to create objects that implements UserSourceInterface.
 */
trait HasUserTrait
{
    use MustHasUser;

    /**
     * @var AuthUserEntity|null
     */
    protected $userEntity;

    /**
     * Get the authenticated user.
     *
     * @return AuthUserEntity|null Authenticated user or null.
     */
    public function getUserEntity(): ?AuthUserEntity
    {
        return $this->userEntity;
    }
}
