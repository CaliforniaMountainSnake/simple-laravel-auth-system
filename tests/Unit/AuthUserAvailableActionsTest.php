<?php

namespace Tests\Unit;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserAvailableActions;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Utils\AuthUserEntityMock;

class AuthUserAvailableActionsTest extends TestCase
{
    use AuthUserEntityMock;

    /**
     * @throws InvalidArgumentException
     * @covers AuthUserAvailableActions::toJson
     */
    public function testToJsonTestToString(): void
    {
        $availableActions = $this->getAuthUserEntityMock()->getAvailableActions();
        $expectedJson = '{"canPostInComments":true,"getMaxCountOfAvatars":5}';

        $this->assertEquals($expectedJson, $availableActions->toJson());
        $this->assertEquals($expectedJson, (string)$availableActions);
    }
}
