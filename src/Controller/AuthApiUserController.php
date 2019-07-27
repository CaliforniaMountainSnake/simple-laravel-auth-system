<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller\Utils\CreateUserEntityFromRequestApiToken;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class AuthApiUserController extends AuthApiController
{
    use AuthApiUserControllerDependencies;
    use CreateUserEntityFromRequestApiToken;

    abstract public function initDependencies(): void;

    /**
     * AuthApiUserController constructor.
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        parent::__construct();
        $this->initDependencies();
        $this->initUserEntity();

        if ($this->getUserEntity() !== null) {
            app()->setLocale((string)$this->getUserEntity()->getLanguage());
        }
    }
}
