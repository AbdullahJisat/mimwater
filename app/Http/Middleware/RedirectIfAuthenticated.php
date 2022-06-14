<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard)
    // public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;
        $guard = empty($guard) ? [null] : $guard;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         switch ($guard) {
        //             case 'admin':
        //                 return redirect(RouteServiceProvider::ADMINHOME);
        //                 break;
        //             case 'salesman':
        //                 return redirect(RouteServiceProvider::HOME);
        //                 break;
        //             case 'retailer':
        //                 return redirect('/ss');
        //                 break;
        //             case 'dealer':
        //                 return redirect('/ss');
        //                 break;
        //             default:
        //                 return redirect('/login');
        //                 break;
        //         }
        //     }
        // }
        // dd($guard);
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin/dashboard');
        }
        if ($guard == "salesman" && Auth::guard($guard)->check()) {
            return redirect('/salesmans/dashboard');
        }
        if ($guard == "dealer" && Auth::guard($guard)->check()) {
            return redirect('/dealers/dashboard');
        }
        if ($guard == "retailer" && Auth::guard($guard)->check()) {
            return redirect('/retailers/dashboard');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
