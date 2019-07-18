<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils;

trait ArrayUtils
{
    /**
     * @param array $_arr
     * @return string[]
     * @throws \LogicException
     */
    protected function stringifyArray(array $_arr): array
    {
        $this->assertArrayElementsAreNotArrays($_arr);
        return \array_map('strval', $_arr);

    }

    /**
     * @noinspection PhpDocRedundantThrowsInspection
     * @param array $_arr
     * @throws \LogicException
     */
    protected function assertArrayElementsAreNotArrays(array $_arr): void
    {
        \array_walk($_arr, static function ($value, $key) {
            if (\is_array($value)) {
                throw new \LogicException('Array element with key "' . $key
                    . '" is an array! You should use only one dimensional array.');
            }
        });
    }
}
