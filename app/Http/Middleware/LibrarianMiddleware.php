<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibrarianMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['librarian', 'admin'])) {
            abort(403, 'Доступ запрещён (только для библиотекаря или админа).');
        }
        return $next($request);
    }
}