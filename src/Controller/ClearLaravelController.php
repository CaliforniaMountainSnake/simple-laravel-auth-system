<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ClearLaravelController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
