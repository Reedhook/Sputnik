<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Middleware для проверки статуса админа.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): mixed
    {
        !Auth::check()?: throw new Exception('Обращаться по данному маршруту могут только неавторизованные пользователи');
        return $next($request);
    }
}
