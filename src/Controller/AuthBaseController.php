<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Controller;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\TrimStrings;

class AuthBaseController extends ClearLaravelController
{
    public function __construct()
    {
        $this->middleware(TrimStrings::class);
        $this->middleware(ConvertEmptyStringsToNull::class);
    }
}
