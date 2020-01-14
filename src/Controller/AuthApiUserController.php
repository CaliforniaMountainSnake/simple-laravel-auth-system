<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserAccountTypeAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserRoleAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces\AuthenticatorInterface;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces\HasUserInterface;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\HasAuthenticatorTrait;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\HasUserTrait;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class AuthApiUserController extends AuthApiController implements HasUserInterface
{
    use AuthApiUserControllerDependencies;
    use HasAuthenticatorTrait;
    use HasUserTrait;
    use AuthUserRoleAccessUtils;
    use AuthUserAccountTypeAccessUtils;

    abstract public function initDependencies(): void;

    /**
     * AuthApiUserController constructor.
     *
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        parent::__construct();
        $this->initDependencies();

        $this->authenticator = app()->make(AuthenticatorInterface::class);
        $this->userEntity = $this->authenticator->getUserEntity();

        if ($this->getUserEntity() !== null) {
            app()->setLocale((string)$this->getUserEntity()->getLanguage());
        }
    }
}
