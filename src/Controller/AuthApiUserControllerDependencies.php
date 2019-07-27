<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller;

use CaliforniaMountainSnake\DatabaseEntities\EntityConvertUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserRepository;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthValidatorServiceInterface;
use Illuminate\Http\Request;

trait AuthApiUserControllerDependencies
{
    /**
     * @return Request
     */
    abstract public function getRequest(): Request;

    /**
     * @return AuthUserRepository
     */
    abstract public function getUserRepository(): AuthUserRepository;

    /**
     * @return AuthUserEntity|null
     */
    abstract public function getUserEntity(): ?AuthUserEntity;

    /**
     * @return EntityConvertUtils
     */
    abstract public function getConvertUtils(): EntityConvertUtils;

    /**
     * @return AuthValidatorServiceInterface
     */
    abstract public function getValidatorService(): AuthValidatorServiceInterface;
}
