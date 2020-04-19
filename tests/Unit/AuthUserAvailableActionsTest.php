<?php

namespace Tests\Unit;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserAvailableActions;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AuthUserAvailableActionsTest extends TestCase
{
    /**
     * @throws InvalidArgumentException
     * @covers AuthUserAvailableActions::toJson
     */
    public function testToJsonTestToString(): void
    {
        $userEntity = $this->createMock(AuthUserEntity::class);
        $availableActions = new class ($userEntity) extends AuthUserAvailableActions
        {
            public function canPostInComments(): bool
            {
                return true;
            }

            public function getMaxCountOfAvatars(): int
            {
                return 5;
            }

            public function ignoredPublicMethod(): string
            {
                return 'test';
            }

            protected function getNotSerializableMethods(): array
            {
                return array_merge(parent::getNotSerializableMethods(), [
                    'ignoredPublicMethod',
                ]);
            }

            protected function protectedMethod(): bool
            {
                return true;
            }

            private function privateMethod(): void
            {

            }

            // Test magic method
            public function __debugInfo(): array
            {
                return ['debug'];
            }
        };

        $expectedJson = '{"canPostInComments":true,"getMaxCountOfAvatars":5}';
        $this->assertEquals($expectedJson, $availableActions->toJson());
        $this->assertEquals($expectedJson, (string)$availableActions);
    }
}
