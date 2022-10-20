<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PreventAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //return response(Auth::user());
        if(Auth::check()){

            if (auth()->user()->role == 'admin'){
                if (! $request->expectsJson()) {
                    abort(ResponseAlias::HTTP_FORBIDDEN);
                }

                return response(['message' => 'Unauthorized'],401);
            }

        }

        return $next($request);


    }
}
