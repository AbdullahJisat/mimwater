<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        // abort_if(!$request->user()->hasRole($role), 404);
        abort_unless($request->user()->hasRole($role), 404);

        abort_if($permission !== null && !$request->user()->can($permission), 404);

        return $next($request);
    }
}