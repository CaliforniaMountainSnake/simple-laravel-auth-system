<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller\Actions;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\AuthUserRoleAccessUtils;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\MustHasUser;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthRoleService;
use Symfony\Component\HttpFoundation\Response;

trait AvailableRoutes
{
    use MustHasUser;
    use AuthUserRoleAccessUtils;

    /**
     * Get user-defined class extends from AuthUserRoleEnum.
     *
     * @return string
     */
    abstract public function getUserRoleEnumClass(): string;

    /**
     * Get user-defined role service object.
     *
     * @return AuthRoleService
     */
    abstract public function getRoleService(): AuthRoleService;

    /**
     * Get api routes that available to current user.
     * Controller's action.
     *
     * @return Response
     */
    public function getUserAvailableRoutes(): Response
    {
        $roleEnumClass = $this->getUserRoleEnumClass();
        $role = $this->getRoleOfUserString($this->getUserEntity());
        $routes = $this->getRoleService()->getRotesByRole(new $roleEnumClass($role));

        return JsonResponse::good($routes)->make();
    }
}
