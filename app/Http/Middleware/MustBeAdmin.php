<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MustBeAdmin
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
        if (Auth::guest() || ! Auth::user()->is_admin) {
            abort(404);
        }
        return $next($request);
    }
}
