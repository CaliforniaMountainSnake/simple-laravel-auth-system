<?php

namespace Tests\Unit;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller\Actions\AvailableActions;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use Tests\Unit\Utils\AuthUserEntityMock;

class ActionsTest extends TestCase
{
    use AvailableActions;
    use AuthUserEntityMock;

    /**
     * @throws InvalidArgumentException
     * @covers AvailableActions::getUserAvailableActions
     */
    public function testMyAvailableActions(): void
    {
        $response = $this->getUserAvailableActions();
        $this->assertEquals('{"' . JsonResponse::IS_OK . '":"true","' . JsonResponse::BODY
            . '":{"canPostInComments":true,"getMaxCountOfAvatars":5}}',
            $response->getContent());
    }
}
