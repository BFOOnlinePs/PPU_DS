<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnsureAuthenticatedWithToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect('/login');
        }

        // تحقق من صحة التوكن إذا لزم الأمر
        $response = Http::withToken($accessToken)
            ->get(env('IDENTITY_SERVER_URL') . '/connect/userinfo');

        if ($response->failed()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
