<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller\Utils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserRepository;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Middleware\AuthMiddleware;
use Illuminate\Http\Request;

/**
 * Получить UserEntity с помощью параметра http-запроса.
 */
trait CreateUserEntityFromRequestApiToken
{
    /**
     * @var AuthUserEntity|null
     */
    private $userEntity;

    /**
     * @return Request
     */
    abstract public function getRequest(): Request;

    /**
     * @return AuthUserRepository
     */
    abstract public function getUserRepository(): AuthUserRepository;


    protected function initUserEntity(): void
    {
        $token = $this->getRequest()->input(AuthMiddleware::API_TOKEN_REQUEST_PARAM);
        if ($token !== null) {
            $this->userEntity = $this->getUserRepository()->getByApiToken($token);
        }
    }

    /**
     * @return AuthUserEntity|null
     */
    public function getUserEntity(): ?AuthUserEntity
    {
        return $this->userEntity;
    }
}
