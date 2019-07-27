<?php

namespace CaliforniaMountainSnake\SimpleLaravelAuthSystem\Middleware;

use Illuminate\Http\Request;

/**
 * Allow Cross-Origin requests.
 * @package App\Http\Middleware
 */
class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');
    }
}
