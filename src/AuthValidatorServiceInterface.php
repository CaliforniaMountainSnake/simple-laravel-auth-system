<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use Illuminate\Contracts\Validation\Validator;

interface AuthValidatorServiceInterface
{
    /**
     * Массив валидации Laravel для параметра "api_token".
     * @return array
     */
    public function api_token(): array;

    /**
     * Создать валидатор.
     *
     * @param array $_data
     * @param array $_rules
     * @param array $_messages
     * @param array $_custom_attributes
     * @return Validator
     */
    public function makeValidator(
        array $_data,
        array $_rules,
        array $_messages = [],
        array $_custom_attributes = []
    ): Validator;
}
