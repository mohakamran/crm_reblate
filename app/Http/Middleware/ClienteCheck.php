<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\DB;

class ClienteCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $emp_code = auth()->user()->user_code;

        if (auth()->user()->user_type === 'admin') {
            return $next($request); // Allow access for admin
        }

        // For manager and employee, check access
        if (in_array(auth()->user()->user_type, ['manager', 'employee'])) {
            $check = DB::table('table_login_details')->where('emp_code', $emp_code)->first();

            $check_emp = $check->clients_access;

            if (!is_array($check_emp)) {
                $employees_access = explode(',', $check_emp);
                // Remove any empty elements resulting from the explode function
                $employees_access = array_filter($employees_access);
            }

            if (is_array($employees_access) && (
                in_array('all', $employees_access) ||
                in_array('create', $employees_access) ||
                in_array('update', $employees_access) ||
                in_array('view', $employees_access) ||
                in_array('delete', $employees_access)
            )) {
                return $next($request);
            } else {
                return response()->view('errors.401', [], 401);
            }
        }
        return $next($request);
    }
}
