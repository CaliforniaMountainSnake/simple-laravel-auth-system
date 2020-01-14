<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Middleware\AuthMiddleware;

/**
 * This methods can be used in tests for perform requests to protected routes.
 */
trait AuthParamsAuthenticatorUtils
{
    /**
     * Add a "api_token" parameter to the given array of request params.
     *
     * @param string|null $_api_token Authentication token.
     * @param array|null  $_params    Request params.
     *
     * @return array The array with params that can be used to preform a POST query.
     */
    public function authPostParams(?string $_api_token, array $_params = null): array
    {
        $authArr = ($_api_token === null ? [] : [AuthMiddleware::API_TOKEN_REQUEST_PARAM => $_api_token]);
        return \array_merge($authArr, $_params ?? []);
    }

    /**
     * Add a "api_token" parameter to the given array of request params.
     *
     * @param string|null $_api_token Authentication token.
     * @param array|null  $_params    Request params.
     *
     * @return string The string that can be concatenated with the end of the url for perform a GET query.
     */
    public function authGetParams(?string $_api_token, array $_params = null): string
    {
        $paramsString = \http_build_query($this->authPostParams($_api_token, $_params ?? []));
        return (empty($paramsString) ? '' : '?' . $paramsString);
    }
}
