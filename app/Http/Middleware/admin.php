<?php

namespace App\Http\Middleware;

use Closure;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if is admin
        if (Auth::user()->isAdmin()) {
            return $next($request); // replace with redirect
        }

        return redirect('/');
    }
}
