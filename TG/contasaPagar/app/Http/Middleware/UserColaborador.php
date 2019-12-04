<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserColaborador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role() != 'G' &&  Auth::user()->role() != 'A' && Auth::user()->role() != 'C' )
            abort(403, 'Usuário não possui acesso a esse recurso.');

        return $next($request);
    }
}
