<?php

namespace Tests\Unit\Utils;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\MustHasUser;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserAvailableActions;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\AuthUserEntity;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;

trait AuthUserEntityMock
{
    use MustHasUser;

    abstract public function getMockBuilder($className): MockBuilder;

    abstract protected function createMock($originalClassName): MockObject;

    /**
     * @return AuthUserEntity|null
     */
    public function getUserEntity(): ?AuthUserEntity
    {
        return $this->getAuthUserEntityMock();
    }

    /**
     * @return AuthUserEntity
     */
    protected function getAuthUserEntityMock(): AuthUserEntity
    {
        $userEntityMock = $this->createMock(AuthUserEntity::class);
        $userEntityMock
            ->method('getAvailableActions')
            ->willReturn(new class ($userEntityMock) extends AuthUserAvailableActions
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
            });

        return $userEntityMock;
    }
}
