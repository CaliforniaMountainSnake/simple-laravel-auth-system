<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Interfaces;

/**
 * Returns the function that hashes the api_token.
 */
interface AuthHashFunction
{
    public function getHashFunction(): callable;
}
