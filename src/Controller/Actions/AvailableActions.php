<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller\Actions;

use CaliforniaMountainSnake\JsonResponse\JsonResponse;
use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Authenticator\Utils\MustHasUser;
use Symfony\Component\HttpFoundation\Response;

trait AvailableActions
{
    use MustHasUser;

    /**
     * Get actions that available to current user.
     * Controller's action.
     *
     * @return Response
     */
    public function getUserAvailableActions(): Response
    {
        $actions = [];
        if ($this->getUserEntity() !== null) {
            $actions = $this->getUserEntity()->getAvailableActions()->toArray();
        }

        return JsonResponse::good($actions)->make();
    }
}
