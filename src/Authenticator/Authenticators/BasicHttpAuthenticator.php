<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Authenticators;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserAccountTypeAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserRoleAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Exceptions\AuthenticationException;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces\AuthenticatorInterface;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\HasUserTrait;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserRepository;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthValidatorServiceInterface;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LogicException;

/**
 * Creates an authenticated user from a HTTP request.
 */
class BasicHttpAuthenticator implements AuthenticatorInterface
{
    use HasUserTrait;
    use AuthUserRoleAccessUtils;
    use AuthUserAccountTypeAccessUtils;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var AuthUserRepository
     */
    protected $userRepository;

    /**
     * @var AuthValidatorServiceInterface
     */
    protected $validatorService;

    /**
     * @var string[]
     */
    protected $roles;

    /**
     * @var string[]
     */
    protected $accountTypes;

    /**
     * @var string
     */
    protected $apiTokenRequestParam;

    /**
     * HttpAuthenticator constructor.
     *
     * @param Request                       $request
     * @param AuthUserRepository            $userRepository
     * @param AuthValidatorServiceInterface $validatorService
     * @param string[]                      $roles
     * @param string[]                      $accountTypes
     * @param string                        $apiTokenRequestParam
     */
    public function __construct(
        Request $request,
        AuthUserRepository $userRepository,
        AuthValidatorServiceInterface $validatorService,
        array $roles,
        array $accountTypes,
        string $apiTokenRequestParam
    ) {
        $this->request = $request;
        $this->userRepository = $userRepository;
        $this->validatorService = $validatorService;
        $this->roles = $roles;
        $this->accountTypes = $accountTypes;
        $this->apiTokenRequestParam = $apiTokenRequestParam;
    }

    /**
     * Create an authenticated user from anywhere.
     * (For example, from HTTP query).
     *
     * @return AuthUserEntity|null The instance of authenticated user or null if not-auth users are allowed.
     * @throws AuthenticationException
     * @throws BindingResolutionException
     * @throws LogicException
     */
    public function authenticateUser(): ?AuthUserEntity
    {
        $token = $this->request->input($this->apiTokenRequestParam);
        $isNotAuthAllowed = \in_array(AuthUserRoleEnum::NOT_AUTH, $this->roles, true);

        $validator = Validator::make($this->request->all(), $this->validatorService->api_token());
        if ($validator->fails()) {
            throw AuthenticationException::fromMessages($validator->errors()->toArray(),
                JsonResponse::HTTP_BAD_REQUEST);
        }

        // Если токен не найден в запросе.
        if ($token === null) {
            if ($isNotAuthAllowed) {
                return null;
            }

            throw new AuthenticationException(
                __('auth_middleware.no_token_error', ['api_token_request_param' => $this->apiTokenRequestParam]),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        // Если токен не найден в БД.
        $this->userEntity = $this->userRepository->getByApiToken($token);
        if ($this->userEntity === null) {
            throw new AuthenticationException(__('auth_middleware.bad_token_error'),
                JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Если роль юзера не содержится в разрешенных.
        if (!$this->isUserRoleEquals($this->userEntity, ...$this->roles)) {
            throw new AuthenticationException(__('auth_middleware.wrong_role_error'),
                JsonResponse::HTTP_FORBIDDEN);
        }

        // Если тип аккаунта юзера не содержится в разрешенных.
        if (!$this->isUserAccountTypeEquals($this->userEntity, ...$this->accountTypes)) {
            throw new AuthenticationException(__('auth_middleware.wrong_account_type_error'),
                JsonResponse::HTTP_PAYMENT_REQUIRED);
        }

        return $this->userEntity;
    }
}
