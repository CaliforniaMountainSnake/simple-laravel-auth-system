<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Exceptions;

use CaliforniaMountainSnake\UtilTraits\UtilsClasses\Utils;
use LogicException;
use Throwable;

class AuthenticationException extends LogicException
{
    /**
     * @var string[]
     */
    protected $messages;

    /**
     * @param array          $messages
     * @param int            $code
     * @param Throwable|null $previous
     *
     * @return AuthenticationException
     */
    public static function fromMessages(array $messages, int $code = 0, Throwable $previous = null): self
    {
        $utils = new Utils();
        $msg = \implode(' ', $utils->array_values_recursive($messages));

        $instance = new self ($msg, $code, $previous);
        $instance->messages = $messages;
        return $instance;
    }

    /**
     * @return string[]
     */
    public function getMessages(): array
    {
        return $this->messages ?? [$this->message];
    }
}
