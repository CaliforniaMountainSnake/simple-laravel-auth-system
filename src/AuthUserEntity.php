<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use CaliforniaMountainSnake\DatabaseEntities\BaseEntity;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthLangsEnum;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserAccountTypeEnum;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Enums\AuthUserRoleEnum;

abstract class AuthUserEntity extends BaseEntity
{
    /**
     * @var string
     */
    protected $api_token;

    /**
     * @var AuthUserRoleEnum
     */
    protected $role;

    /**
     * @var AuthLangsEnum
     */
    protected $language;

    /**
     * Дата, до которой оплачен аккаунт, в формате Y-m-d H:i:s.
     * @var string
     */
    protected $paid_to;

    /**
     * @return AuthUserAccountTypeEnum
     */
    abstract public function getAccountType(): AuthUserAccountTypeEnum;

    /**
     * @return AuthUserAvailableActions
     */
    abstract public function getAvailableActions(): AuthUserAvailableActions;

    /**
     * @return AuthUserRoleEnum
     */
    abstract public function getRole(): AuthUserRoleEnum;

    /**
     * @return AuthLangsEnum
     */
    abstract public function getLanguage(): AuthLangsEnum;

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->api_token;
    }

    /**
     * @return string
     */
    public function getPaidTo(): string
    {
        return $this->paid_to;
    }

    /**
     * @return int
     */
    public function getPaidToTimestamp(): int
    {
        return $this->getUnixTimestampFromYmdHisTime($this->paid_to);
    }
}
