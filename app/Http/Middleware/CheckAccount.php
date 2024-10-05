<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if ($request->route()->getName() == 'logout') {
                return $next($request);
            }

            // Kiểm tra xác minh email
            if (auth()->user()->email_verified == 0 || auth()->user()->email_verified == NULL) {
                $excludedRoutes = ['verification.verify', 'verify', 'postVerify'];
                if (!in_array($request->route()->getName(), $excludedRoutes)) {
                    return redirect(route('verify'));
                }
            }

        }
        return $next($request);
    }
}
