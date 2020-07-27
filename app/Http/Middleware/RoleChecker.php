<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $super_adminRole, $adminRole,  $sellerRole)
    {
        $roles = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];

        if (in_array($super_adminRole, $roles)) {
            return $next($request);
        } else if (in_array($adminRole, $roles)) {
            return $next($request);
        } else if (in_array($sellerRole, $roles)) {
            return $next($request);
        }

        return Redirect::route('home');
    }
}
