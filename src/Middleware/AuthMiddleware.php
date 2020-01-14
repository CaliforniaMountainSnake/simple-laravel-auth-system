<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Middleware;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Authenticators\BasicHttpAuthenticator;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Exceptions\AuthenticationException;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\HasAuthenticatorTrait;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthRoleService;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserRepository;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthValidatorServiceInterface;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;

/**
 * Простой посредник для аутентификации и авторизации клиентов.
 */
class AuthMiddleware
{
    use HasAuthenticatorTrait;

    public const API_TOKEN_REQUEST_PARAM = 'api_token';

    /**
     * @var AuthUserRepository
     */
    protected $userRepository;

    /**
     * @var AuthValidatorServiceInterface
     */
    protected $validatorService;

    /**
     * AuthMiddleware constructor.
     *
     * @param AuthUserRepository            $_user_repository
     * @param AuthValidatorServiceInterface $_validator_service
     */
    public function __construct(AuthUserRepository $_user_repository, AuthValidatorServiceInterface $_validator_service)
    {
        $this->userRepository = $_user_repository;
        $this->validatorService = $_validator_service;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request  $_request
     * @param Closure  $_next
     * @param string[] $_config
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function handle($_request, Closure $_next, string ...$_config)
    {
        // Get params.
        [$roles, $accountTypes] = $this->getRolesAndAccountTypes(...$_config);

        // Create the authenticator.
        $this->authenticator = app()->make(BasicHttpAuthenticator::class, [
            $_request,
            $this->userRepository,
            $this->validatorService,
            $roles,
            $accountTypes,
            self::API_TOKEN_REQUEST_PARAM
        ]);

        try {
            $this->authenticator->authenticateUser();
        } catch (AuthenticationException $e) {
            return JsonResponse::error($e->getMessages(), $e->getCode())->make();
        }

        return $_next($_request);
    }

    /**
     * @param string ...$_config
     *
     * @return array [string[], string[]].
     */
    protected function getRolesAndAccountTypes(string ...$_config): array
    {
        $isSeparated = false;
        $roles = [];
        $accountTypes = [];
        foreach ($_config as $item) {
            if ($item === AuthRoleService::ROLES_AND_ACCOUNT_TYPES_SEPARATOR) {
                $isSeparated = true;
                continue;
            }
            if ($isSeparated) {
                $accountTypes[] = $item;
                continue;
            }

            $roles[] = $item;
        }

        return [$roles, $accountTypes];
    }
}
