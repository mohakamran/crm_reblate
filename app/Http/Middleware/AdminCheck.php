<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\DB;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $emp_code = auth()->user()->user_code;

        if (in_array(auth()->user()->user_type, ['admin', 'manager'])) {
            return $next($request); // Allow access for admin
        } else {
            return response()->view('errors.401', [], 401);
        }


        return $next($request);
    }
}
