<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

interface AuthValidatorServiceInterface
{
    /**
     * Массив валидации Laravel для параметра "api_token".
     * @return array
     */
    public function api_token(): array;
}
