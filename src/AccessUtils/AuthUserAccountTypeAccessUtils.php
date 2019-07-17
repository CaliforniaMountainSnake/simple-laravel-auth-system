<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils\Exceptions\UserAccountTypeNotEqualsException;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserAccountTypeEnum;

/**
 * Утилиты для проверки соответствия типа аккаунта юзера заданным типам аккаунтов.
 */
trait AuthUserAccountTypeAccessUtils
{
    use StringifyUtils;

    /**
     * Соответствует ли тип аккаунта юзера одному из заданных?
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserAccountTypeEnum[]|string[] $_account_types
     *
     * @return bool
     */
    public function isUserAccountTypeEquals(?AuthUserEntity $_user_entity, ...$_account_types): bool
    {
        if ($_user_entity === null) {
            return false;
        }

        return \in_array((string)$_user_entity->getAccountType(), $this->stringifyArray($_account_types), true);
    }

    /**
     * Выбросить исключение, если тип аккаунта юзера не соответствует ни одному из заданных.
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserAccountTypeEnum[]|string[] $_account_types
     *
     * @throws UserAccountTypeNotEqualsException
     */
    public function assertUserAccountTypeEquals(?AuthUserEntity $_user_entity, ...$_account_types): void
    {
        if (!$this->isUserAccountTypeEquals($_user_entity, $_account_types)) {
            throw new UserAccountTypeNotEqualsException('Your account type does not equal to one of ['
                . \implode(', ', $_account_types) . ']!');
        }
    }
}
