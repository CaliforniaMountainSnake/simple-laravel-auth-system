<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccountTypeUtils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccountTypeUtils\Exceptions\AccountTypeNotEqualsException;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserAccountTypeEnum;

trait AuthUserAccountTypesUtils
{
    /**
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserAccountTypeEnum $_account_type
     * @return bool
     */
    public function isAccountTypeEquals(?AuthUserEntity $_user_entity, AuthUserAccountTypeEnum $_account_type): bool
    {
        if ($_user_entity === null) {
            return false;
        }

        return ((string)$_user_entity->getAccountType() === (string)$_account_type);
    }

    /**
     * @param AuthUserEntity|null $_user_entity
     * @param AuthUserAccountTypeEnum $_account_type
     * @throws AccountTypeNotEqualsException
     */
    public function assertAccountTypeEquals(?AuthUserEntity $_user_entity, AuthUserAccountTypeEnum $_account_type): void
    {
        if (!$this->isAccountTypeEquals($_user_entity, $_account_type)) {
            throw new AccountTypeNotEqualsException('Your account type does not equal to "'
                . $_account_type . '"!');
        }
    }
}
