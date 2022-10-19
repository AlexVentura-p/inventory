<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CheckIfCustomer
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

        if(auth()->user()->exists){

            if (auth()->user()->role == 'customer'){
                return $next($request);
            }

        }

        if (! $request->expectsJson()) {

            if(auth()->guest()){
                return redirect('login');
            }

            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        return response(['message' => 'Unauthorized'],401);

    }
}
