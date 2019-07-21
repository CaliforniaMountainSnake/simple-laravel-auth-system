<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\Exceptions\UserRoleNotEqualsException;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;

/**
 * Утилиты для проверки соответствия роли юзера заданным ролям.
 */
trait AuthUserRoleAccessUtils
{
    use ArrayUtils;

    /**
     * Соответствует ли роль юзера одной из заданных?
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserRoleEnum[]|string[] $_roles
     *
     * @return bool
     *
     * @throws \LogicException
     */
    public function isUserRoleEquals(?AuthUserEntity $_user_entity, ...$_roles): bool
    {
        return \in_array($this->getRoleOfUserString($_user_entity), $this->stringifyArray($_roles), true);
    }

    /**
     * Выбросить исключение, если роль юзера не соответствует ни одной из заданных.
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserRoleEnum[]|string[] $_roles
     *
     * @throws UserRoleNotEqualsException
     * @throws \LogicException
     */
    public function assertUserRoleEquals(?AuthUserEntity $_user_entity, ...$_roles): void
    {
        if (!$this->isUserRoleEquals($_user_entity, ...$_roles)) {
            throw new UserRoleNotEqualsException('Your role does not equal to one of [' . \implode(', ',
                    $_roles) . ']!');
        }
    }

    /**
     * Получить роль юзера В СТРОКОВОМ ВИДЕ.
     *
     * @param AuthUserEntity|null $_user
     * @return string
     */
    public function getRoleOfUserString(?AuthUserEntity $_user): string
    {
        return ($_user === null) ? AuthUserRoleEnum::NOT_AUTH : (string)$_user->getRole();
    }
}
