<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        if ($request->ajax()) {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', '0');
        }
        
        return $response;
    }
}
