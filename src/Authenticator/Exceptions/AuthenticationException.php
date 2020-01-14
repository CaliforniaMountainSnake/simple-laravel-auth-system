<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Exceptions;

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
    public static function fromMessages($messages = [], $code = 0, Throwable $previous = null): self
    {
        $instance = new self (\implode(' ', $messages), $code, $previous);
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
