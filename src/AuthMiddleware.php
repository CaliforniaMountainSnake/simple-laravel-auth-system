<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserAccountTypeAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserRoleAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Простой посредник для аутентификации и авторизации клиентов.
 */
class AuthMiddleware
{
    use AuthUserRoleAccessUtils;
    use AuthUserAccountTypeAccessUtils;

    public const API_TOKEN_REQUEST_PARAM = 'api_token';

    /**
     * @var AuthUserRepository
     */
    protected $userRepository;

    /**
     * @var AuthValidatorServiceInterface
     */
    protected $validatorService;

    public function __construct(AuthUserRepository $_user_repository, AuthValidatorServiceInterface $_validator_service)
    {
        $this->userRepository   = $_user_repository;
        $this->validatorService = $_validator_service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request $_request
     * @param  \Closure $_next
     * @param string[] $_config
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function handle($_request, \Closure $_next, string ...$_config)
    {
        [$roles, $accountTypes] = $this->getRolesAndAccountTypes(...$_config);
        $token            = $_request->input(self::API_TOKEN_REQUEST_PARAM);
        $isNotAuthAllowed = \in_array(AuthUserRoleEnum::NOT_AUTH, $roles, true);

        $validator = Validator::make($_request->all(), $this->validatorService->api_token());
        if ($validator->fails()) {
            return JsonResponse::error($validator->errors()->toArray(), Response::HTTP_BAD_REQUEST)->make();
        }

        // Если токен не найден в запросе.
        if ($token === null) {
            if ($isNotAuthAllowed) {
                return $_next($_request);
            }

            return JsonResponse::error([
                __('auth_middleware.no_token_error', ['api_token_request_param' => self::API_TOKEN_REQUEST_PARAM])
            ], Response::HTTP_BAD_REQUEST)->make();
        }

        // Если токен не найден в БД.
        $userEntity = $this->userRepository->getByApiToken($token);
        if ($userEntity === null) {
            return JsonResponse::error([__('auth_middleware.bad_token_error')],
                Response::HTTP_UNAUTHORIZED)->make();
        }

        // Если роль юзера не содержится в разрешенных.
        if (!$this->isUserRoleEquals($userEntity, $roles)) {
            return JsonResponse::error([__('auth_middleware.wrong_role_error')],
                Response::HTTP_FORBIDDEN)->make();
        }

        // Если тип аккаунта юзера не содержится в разрешенных.
        if (!$this->isUserAccountTypeEquals($userEntity, $accountTypes)) {
            return JsonResponse::error([__('auth_middleware.wrong_account_type_error')],
                Response::HTTP_PAYMENT_REQUIRED)->make();
        }

        return $_next($_request);
    }

    protected function getRolesAndAccountTypes(string ...$_config): array
    {
        $isSeparated  = false;
        $roles        = [];
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
