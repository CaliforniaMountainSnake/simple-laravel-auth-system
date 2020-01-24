<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LogicException;

/**
 * The request object that contains also route parameters.
 */
class FullRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @param null $keys
     *
     * @return array
     * @throws LogicException
     */
    public function all($keys = null): array
    {
        return \array_merge(parent::all($keys), $this->route()->parameters());
    }

    /**
     * @param null $key
     * @param null $default
     *
     * @return array|string|null
     * @throws LogicException
     */
    public function input($key = null, $default = null)
    {
        return parent::input($key, $default) ?? $this->route()->parameter($key);
    }
}
