<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class IncrementalBlockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
//         Determine the maximum number of attempts allowed
        $maxAttempts = 5;
        $initialDecaySeconds = 60;
        $key = 'login_attempts_' . $request->email ?: $request->ip();
//        $limit = Limit::perMinute( $maxAttempts)->by($key);
//        $hit = RateLimiter::hit($key, $initialDecaySeconds);
//        $remainingAttempts = $maxAttempts - RateLimiter::hit($key, $initialDecaySeconds);
        $available = RateLimiter::availableIn($key);
//
//        \Log::info("hit: {$hit}");
//        \Log::info("decaySeconds: {$initialDecaySeconds}");
        \Log::info("available: {$available}");
//        \Log::info("remainingAttempts: {$remainingAttempts}");
//        \Log::info("limit: ". json_encode($limit));

        $executed = RateLimiter::attempt(
            $key,
            $perTwoMinutes = $maxAttempts,
            function () {
                // Send message...
            },
            $decayRate = $initialDecaySeconds,
        );

        if (RateLimiter::tooManyAttempts($key, 8)) {
//            RateLimiter::hit($key);
//            $sec = $initialDecaySeconds*5;
//            RateLimiter::increment($key, $sec, 5);
            dd('10');
        }

        if (!$executed) {
            RateLimiter::hit($key, 300);
//            $sec = $initialDecaySeconds*5;
//            RateLimiter::increment($key, $sec, 5);
            return 'Too many messages sent!';
        }
        RateLimiter::hit($key);
        return $next($request);
    }

//    public function handle($request, Closure $next)
//    {
//        // Define a key to identify the user
//        $key = 'login_attempts_' . $request->ip(); // Using IP as the key
//
//        // Determine the maximum number of attempts allowed
//        $maxAttempts = 6;
//
//        // Determine the initial decay time (in minutes) for the attempts
//        $initialDecayMinutes = 15 * 60;
//
//        // Determine the increment in decay time (in minutes) for each threshold
//        $incrementDecayMinutes = 30 * 60;
//
//        // Determine the decay time for the current attempt based on the number of attempts
//        $remainingAttempts = $maxAttempts - RateLimiter::hit($key, $initialDecayMinutes);
//
//        // Debugging: Log the remaining attempts
//        \Log::info("Remaining Attempts: {$remainingAttempts}");
//
//        // Calculate the decay time for the current attempt
//        $decayMinutes = $initialDecayMinutes + ($incrementDecayMinutes * (ceil($remainingAttempts / 3) - 1));
//
//        // Debugging: Log the calculated decay minutes
//        \Log::info("Calculated Decay Minutes: {$decayMinutes}");
//
//        // Check if the user has exceeded the maximum number of attempts
//        if ($remainingAttempts <= 0) {
//            \Log::info("Remaining Attempts: {$remainingAttempts}");
//            // The user is allowed to proceed with the login attempt
//            // The rate limit has expired, reset the rate limiter for this user
//            RateLimiter::clear($key);
//            // Proceed with the request
//            return $next($request);
//        }
//
//        // The user is blocked for the current attempt
//        $remainingTime = RateLimiter::availableIn($key);
//
//        // Debugging: Log the remaining time
//        \Log::info("Remaining Time: {$remainingTime}");
//
//        return response("Too many login attempts. Please try again in {$remainingTime} seconds.", 429);
//    }
}
