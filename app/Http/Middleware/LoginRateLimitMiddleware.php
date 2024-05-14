<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handle an incoming request.
 *
 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
 */
class LoginRateLimitMiddleware
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next)
    {
//        if ($request->is('api/*') && $request->headers->has('X-RateLimit-Limit')) {
//            return $next($request); // Skip processing if throttled by Laravel's throttle:api middleware
//        }

        $key = $request->email ?: $request->ip(); //key to identify the user.


//        if (RateLimiter::tooManyAttempts($key, $perMinute =3)) {
//            dd('paici');
////            $seconds = RateLimiter::availableIn('send-message:'.$user->id);
//
//            return 'You may try again in '.$seconds.' seconds.';
//        }

        if (RateLimiter::tooManyAttempts($key, 1)) {
            dd('efefef');
            return 'Too many attempts tyt!';
        }

//        if ($this->limiter->tooManyAttempts($key, 3)) {
//            // User has reached 3 login attempts, block for 15 minutes
//            return $this->buildResponse(1 * 60);
//        }
//
//        if ($this->limiter->tooManyAttempts($key, 6)) {
//            // User has reached 6 login attempts, block for 45 minutes
//            return $this->buildResponse(3 * 60);
//        }

        return $next($request);
    }

    protected function buildResponse($seconds)
    {
        $retryAfter = $seconds / 60; // Convert seconds to minutes
        return response()->json(['message' => 'Too many login attempts. Please try again later.'], 429)
            ->header('Retry-After', $retryAfter);
    }
}

