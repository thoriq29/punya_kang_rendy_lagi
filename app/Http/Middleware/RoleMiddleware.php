<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleSlug)
    {
        if (auth()->check() && auth()->user()->role != $roleSlug) {
            return abort(403, 'Sorry, you don’t have permission to access this page');
        }

        return $next($request);
    }

}
