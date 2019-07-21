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
    use ArrayUtils;

    /**
     * Соответствует ли тип аккаунта юзера одному из заданных?
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserAccountTypeEnum[]|string[] $_account_types
     *
     * @return bool
     *
     * @throws \LogicException
     */
    public function isUserAccountTypeEquals(?AuthUserEntity $_user_entity, ...$_account_types): bool
    {
        return \in_array($this->getAccountTypeOfUserString($_user_entity), $this->stringifyArray($_account_types),
            true);
    }

    /**
     * Выбросить исключение, если тип аккаунта юзера не соответствует ни одному из заданных.
     *
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserAccountTypeEnum[]|string[] $_account_types
     *
     * @throws UserAccountTypeNotEqualsException
     * @throws \LogicException
     */
    public function assertUserAccountTypeEquals(?AuthUserEntity $_user_entity, ...$_account_types): void
    {
        if (!$this->isUserAccountTypeEquals($_user_entity, ...$_account_types)) {
            throw new UserAccountTypeNotEqualsException('Your account type does not equal to one of ['
                . \implode(', ', $_account_types) . ']!');
        }
    }

    /**
     * Получить тип аккаунта юзера В СТРОКОВОМ ВИДЕ.
     *
     * @param AuthUserEntity|null $_user
     * @return string
     */
    public function getAccountTypeOfUserString(?AuthUserEntity $_user): string
    {
        return ($_user === null) ? AuthUserAccountTypeEnum::FREE : (string)$_user->getAccountType();
    }
}
