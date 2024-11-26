<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $type)
    {
        if (Auth::check()) {
            $email = Auth::user()->email;

            if ($type === 'admin' && str_ends_with($email, '@admin.com')) {
                return $next($request);
            }

            if ($type === 'user' && str_ends_with($email, '@gmail.com')) {
                return $next($request);
            }
        }

        abort(403, 'Access denied.');
    }

}
