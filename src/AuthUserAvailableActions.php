<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;

/**
 * Доступные для пользователя действия.
 */
abstract class AuthUserAvailableActions
{
    /**
     * @var AuthUserEntity
     */
    protected $userEntity;

    /**
     * Serializable methods must not contain any parameters.
     *
     * @var string[]
     */
    protected $serializableMethods;

    /**
     * AuthUserAvailableActions constructor.
     *
     * @param AuthUserEntity $userEntity
     */
    public function __construct(AuthUserEntity $userEntity)
    {
        $this->userEntity = $userEntity;
        $this->lateInitSerializableMethods();
    }

    /**
     * Returns calculated values of serializable methods.
     *
     * @return array
     */
    public function toArray(): array
    {
        $calculatedValues = [];
        foreach ($this->serializableMethods as $method) {
            $calculatedValues[$method] = $this->{$method}();
        }
        return $calculatedValues;
    }

    /**
     * Returns calculated values of serializable methods.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * Get methods that should not be serialized in functions like "toJson()".
     *
     * @return string[]
     */
    protected function getNotSerializableMethods(): array
    {
        return [
            'getNotSerializableMethods',
            'toArray',
            'toJson',
            '__construct',
            '__destruct',
            '__call',
            '__callStatic',
            '__get',
            '__set',
            '__isset',
            '__unset',
            '__sleep',
            '__wakeup',
            '__serialize',
            '__unserialize',
            '__toString',
            '__invoke',
            '__set_state',
            '__clone',
            '__debugInfo',
        ];
    }

    /**
     * Get serializable methods of the class just once.
     */
    private function lateInitSerializableMethods(): void
    {
        if ($this->serializableMethods !== null) {
            return;
        }

        try {
            $reflection = new ReflectionClass(static::class);
        } catch (ReflectionException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $index => $method) {
            if ($method->isAbstract() || $method->isConstructor() || $method->isDestructor()
                || in_array($method->getName(), $this->getNotSerializableMethods(), true)
            ) {
                continue;
            }
            $this->serializableMethods[] = $method->getName();
        }
    }
}
