<?php

namespace App\Http\Middleware;

use Closure;

class RolecMiddleware
{

    public function handle($request, Closure $next, $role, $permission = null)
    {
        // dd($request->user('admin'));
        abort_if(!$request->user('admin')->hasRole($role), 403);
        // abort_unless($request->user()->hasRole($role), 404);
        // if(!$request->user()->hasRole($role)) {

        //      abort(404);

        // }

        // if($permission !== null && !$request->user()->can($permission)) {

        //       abort(404);
        // }
        abort_if($permission !== null && !$request->user()->can($permission), 404);

        return $next($request);

    }
}
