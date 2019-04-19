<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

/**
 * Доступные для пользователя действия.
 */
abstract class AuthUserAvailableActions
{
    /**
     * @var AuthUserEntity
     */
    protected $userEntity;

    public function __construct(AuthUserEntity $userEntity)
    {
        $this->userEntity = $userEntity;
    }
}
