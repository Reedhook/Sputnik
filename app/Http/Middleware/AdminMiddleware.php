<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $admin = Auth::user();
        $admin['is_admin']?:throw new Exception('Данный маршрут только для администраторов');
        return $next($request);
    }
}
