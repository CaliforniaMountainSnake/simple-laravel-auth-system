<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use Illuminate\Contracts\Validation\Validator;

abstract class AuthValidatorService implements AuthValidatorServiceInterface
{
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
    ): Validator {
        return \Illuminate\Support\Facades\Validator::make($_data, $_rules, $_messages, $_custom_attributes);
    }
}
