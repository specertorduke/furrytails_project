<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogger;

class SessionTimeout
{
    /**
     * Idle timeout in minutes before the session is invalidated.
     * Configurable via SESSION_IDLE_TIMEOUT in .env (default: 30).
     */
    private function timeoutSeconds(): int
    {
        return (int) env('SESSION_IDLE_TIMEOUT', 30) * 60;
    }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');

            if ($lastActivity && (time() - $lastActivity) > $this->timeoutSeconds()) {
                $userId  = Auth::id();
                $minutes = (int) env('SESSION_IDLE_TIMEOUT', 30);

                // Log the automatic timeout before destroying the session
                ActivityLogger::log(
                    'users',
                    $userId,
                    'session_timeout',
                    null,
                    ['reason' => "Idle timeout after {$minutes} minutes"]
                );

                Auth::logout();
                $request->session()->flush();
                $request->session()->regenerateToken();

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Session expired due to inactivity. Please log in again.',
                    ], 401);
                }

                return redirect()->route('login')
                    ->withErrors(['session' => 'Your session has expired due to inactivity. Please log in again.']);
            }

            // Refresh the last-activity timestamp on every authenticated request
            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
