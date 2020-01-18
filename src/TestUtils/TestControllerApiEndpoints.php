<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\TestUtils;

trait TestControllerApiEndpoints
{
    /**
     * @return string
     */
    public function TEST_ACTION_FOR_ALL_USERS(): string
    {
        return 'test_action_for_all_users';
    }

    /**
     * @return string
     */
    public function TEST_ACTION_ONLY_FOR_AUTHORIZED_USERS(): string
    {
        return 'test_action_only_for_authorized_users';
    }

    /**
     * @return string
     */
    public function TEST_ACTION_ONLY_FOR_ADMIN_USERS(): string
    {
        return 'test_action_only_for_admin_users';
    }

    /**
     * @return string
     */
    public function TEST_ACTION_ONLY_FOR_NOT_FREE_USERS(): string
    {
        return 'test_action_only_for_not_free_users';
    }
}
