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
    use StringifyUtils;

    /**
     * Соответствует ли роль юзера одной из заданных?
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserRoleEnum[]|string[] $_roles
     *
     * @return bool
     */
    public function isUserRoleEquals(?AuthUserEntity $_user_entity, ...$_roles): bool
    {
        if ($_user_entity === null) {
            return false;
        }

        return \in_array((string)$_user_entity->getRole(), $this->stringifyArray($_roles), true);
    }

    /**
     * Выбросить исключение, если роль юзера не соответствует ни одной из заданных.
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserRoleEnum[]|string[] $_roles
     *
     * @throws UserRoleNotEqualsException
     */
    public function assertUserRoleEquals(?AuthUserEntity $_user_entity, ...$_roles): void
    {
        if (!$this->isUserRoleEquals($_user_entity, $_roles)) {
            throw new UserRoleNotEqualsException('Your role does not equal to one of [' . \implode(', ',
                    $_roles) . ']!');
        }
    }
}
