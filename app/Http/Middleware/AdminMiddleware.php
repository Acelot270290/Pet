<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->cargo_id == 1) {
            return $next($request);
        }

        return response()->json(['message' => 'Acesso negado. Apenas administradores.'], 403);
    }
}
