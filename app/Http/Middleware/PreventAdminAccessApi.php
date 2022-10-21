<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PreventAdminAccessApi
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

        if(Auth::guard('api')->check()){

            if ($request->user('api')->role == 'admin'){

                return $this->invalidAccesResponse($request);

            }
        }

        return $next($request);

    }

    private function invalidAccesResponse(Request $request)
    {
        if (!$request->expectsJson()) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        return response(['message' => 'Forbidden'],403);
    }

}
