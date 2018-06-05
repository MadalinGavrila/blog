<?php

namespace App\Http\Middleware;

use Closure;

class Active
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
        if(!auth()->check()){
            abort(404);
        }

        if(!$request->user()->isActive()){
            abort(404);
        }

        return $next($request);
    }
}
