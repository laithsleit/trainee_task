<?php
namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * Check if the authenticated user has the specified role.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param ...$roles The roles expected to access the route.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role):Response
    {
        if ($request->user()->Role !== $role)
        {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }

}
