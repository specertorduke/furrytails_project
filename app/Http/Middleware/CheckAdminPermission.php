<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware('admin.permission:permission.name')
     */
    public function handle(Request $request, Closure $next, string $permission): mixed
    {
        $user = auth()->user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        if (!$user->hasPermission($permission)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success'  => false,
                    'message'  => 'You do not have permission to perform this action.',
                ], 403);
            }

            abort(403, 'Access denied. Your admin role does not allow access to this section.');
        }

        return $next($request);
    }
}
