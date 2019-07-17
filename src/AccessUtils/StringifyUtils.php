<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\AccessUtils;

trait StringifyUtils
{
    /**
     * @param array $_arr
     * @return string[]
     */
    protected function stringifyArray(array $_arr): array
    {
        return \array_map('strval', $_arr);
    }
}
