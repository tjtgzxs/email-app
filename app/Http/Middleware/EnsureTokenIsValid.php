<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('X-Auth-Token') !== 'TI4AlasEio') {
            return response()->json([
                'code'=>201,
                'msg'=>"Not Ensure"
            ]);
        }
        return $next($request);
    }
}
