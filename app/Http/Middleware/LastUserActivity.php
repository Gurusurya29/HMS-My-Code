<?php

namespace App\Http\Middleware;

use Auth;
use Cache;
use Carbon\Carbon;
use Closure;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(3);
            Cache::put('user-is-online-' . Auth::user()->uuid, true, $expiresAt);
        }

        return $next($request);
    }
}
