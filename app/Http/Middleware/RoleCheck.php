<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403);
        }

        if ($user->is_banned) {
            Auth::logout();
            return redirect()->route('login')->with('status', 'Your account is banned.');
        }

        $roleName = $user->role?->name;

        if (empty($roles)) {
            return $next($request);
        }

        if (!in_array($roleName, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
