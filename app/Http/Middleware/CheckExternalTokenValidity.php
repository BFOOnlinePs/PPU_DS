<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\CustomIdentityServerProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckExternalTokenValidity
{
    protected $provider;

    public function __construct(CustomIdentityServerProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('auth_token')) {

            $accessToken = session('auth_token');

            try {
                Log::info('Token being checked: ' . session('auth_token'));

                $response = $this->provider->getUserInfo($accessToken);

                Log::info('Token check status: ' . $response->status());
                if ($response->status() === 401) {
                    // التوكن منتهي أو غير صالح
                    session()->forget(['auth_token']);
                    Auth::logout();

                    return redirect()->route('login')
                        ->withErrors(['session_expired' => 'انتهت الجلسة، يرجى تسجيل الدخول مجددًا.']);
                }
            } catch (\Exception $e) {
                // خطأ في الاتصال أو في التوكن
                session()->forget(['auth_token']);
                Auth::logout();

                return redirect()->route('login')
                    ->withErrors(['session_expired' => 'انتهت الجلسة، يرجى تسجيل الدخول مجددًا.']);
            }
        }

        return $next($request);
    }
}
