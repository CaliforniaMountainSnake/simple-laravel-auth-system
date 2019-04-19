<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserAccountTypeEnum;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;
use Illuminate\Routing\Route;

class AuthRoleService
{
    public const ROLES_AND_ACCOUNT_TYPES_SEPARATOR = '|';
    public const METHODS                           = 'methods';
    public const ROUTE                             = 'route';
    public const ROLES                             = 'roles';
    public const ACCOUNT_TYPES                     = 'account_types';

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @param Route $_route
     * @param AuthUserRoleEnum[] $_roles
     * @param AuthUserAccountTypeEnum[] $_account_types
     */
    public function setRote(Route $_route, array $_roles, array $_account_types): void
    {
        $_route->middleware($this->rolesMiddleware($_roles, $_account_types));

        $this->routes[] = [
            self::METHODS => $_route->methods(),
            self::ROUTE => $_route->uri(),
            self::ROLES => $_roles,
            self::ACCOUNT_TYPES => $_account_types,
        ];
    }

    /**
     * @return array
     */
    public function getRotes(): array
    {
        return $this->routes;
    }

    /**
     * @param AuthUserRoleEnum $_role
     * @return array
     */
    public function getRotesByRole(AuthUserRoleEnum $_role): array
    {
        $result = [];
        foreach ($this->routes as $route) {
            /** @noinspection TypeUnsafeArraySearchInspection */
            if (\in_array((string)$_role, $route[self::ROLES])) {
                $result[] = $route;
            }
        }

        return $result;
    }

    /**
     * @param AuthUserAccountTypeEnum $_account_type
     * @return array
     */
    public function getRotesByAccountType(AuthUserAccountTypeEnum $_account_type): array
    {
        $result = [];
        foreach ($this->routes as $route) {
            /** @noinspection TypeUnsafeArraySearchInspection */
            if (\in_array((string)$_account_type, $route[self::ACCOUNT_TYPES])) {
                $result[] = $route;
            }
        }

        return $result;
    }

    /**
     * @param AuthUserRoleEnum[] $_roles
     * @param AuthUserAccountTypeEnum[] $_account_types
     * @return string
     */
    protected function rolesMiddleware(array $_roles, array $_account_types): string
    {
        $rolesStr        = \implode(',', $_roles);
        $accountTypesStr = \implode(',', $_account_types);

        return AuthMiddleware::class . ':' . $rolesStr . ',' . self::ROLES_AND_ACCOUNT_TYPES_SEPARATOR . ','
            . $accountTypesStr;
    }
}
