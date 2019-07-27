<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller;

use CaliforniaMountainSnake\SimpleLaravelAuthSystem\Middleware\CorsMiddleware;

class AuthApiController extends AuthBaseController
{
    public function __construct()
    {
        parent::__construct();

        // set Access-Control-Allow-Origin: *
        if ($this->isEnableCors()) {
            $this->middleware(CorsMiddleware::class);
        }
    }

    /**
     * @return bool
     */
    protected function isEnableCors(): bool
    {
        return true;
    }
}
