<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRealtorProfileComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user && $user->isRealtor() && ! $user->onboarding_completed_at) {
            if ($request->routeIs('realtor.onboarding.*')) {
                return $next($request);
            }

            return redirect()->route('realtor.onboarding.edit');
        }

        return $next($request);
    }
}
