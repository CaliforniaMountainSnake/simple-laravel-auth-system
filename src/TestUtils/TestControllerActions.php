<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\TestUtils;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserAccountTypeAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserRoleAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\MustHasUser;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserAccountTypeEnum;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;
use Symfony\Component\HttpFoundation\Response;

/**
 * Include this trait in some controller to have test possibilities.
 */
trait TestControllerActions
{
    use AuthUserAccountTypeAccessUtils;
    use AuthUserRoleAccessUtils;
    use MustHasUser;
    use RequireAdminRoles;

    /**
     * Test action.
     * For all users, including not-auth.
     *
     * @return Response
     */
    public function testActionForAllUsers(): Response
    {
        return JsonResponse::good(['Good!'])->make();
    }

    /**
     * Test action.
     * Only for authorized users.
     *
     * @return Response
     */
    public function testActionOnlyForAuthorizedUsers(): Response
    {
        if ($this->getRoleOfUserString($this->getUserEntity()) !== AuthUserRoleEnum::NOT_AUTH) {
            return JsonResponse::good(['Good, you ARE an auth user!'])->make();
        }

        return JsonResponse::error(['No, you are NOT an auth user('],
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR)->make();
    }

    /**
     * Test action.
     * Only for admin users (Authorized user that has higher permissions than usual authorized user).
     *
     * @return Response
     * @see AuthSystemTest
     */
    public function testActionOnlyForAdminUsers(): Response
    {
        if (\in_array($this->getRoleOfUserString($this->getUserEntity()), $this->getAdminRoles(), false)) {
            return JsonResponse::good(['Good, you ARE an admin!'])->make();
        }

        return JsonResponse::error(['No, you are NOT an admin('],
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR)->make();
    }

    /**
     * Test action.
     * Only for not-free users (paid, etc).
     *
     * @return Response
     * @see AuthSystemTest
     */
    public function testActionOnlyForNotFreeUsers(): Response
    {
        if ($this->getAccountTypeOfUserString($this->getUserEntity()) !== AuthUserAccountTypeEnum::FREE) {
            return JsonResponse::good(['Good, you are NOT a free user!'])->make();
        }

        return JsonResponse::error(['No, you ARE a free user('],
            JsonResponse::HTTP_INTERNAL_SERVER_ERROR)->make();
    }
}
