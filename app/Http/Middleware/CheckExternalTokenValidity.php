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
        if (session()->has('auth_token') && Auth::check()) {
            $accessToken = session('auth_token');
            $storedToken = Auth::user()->last_access_token;

            // ✅ التحقق المحلي: التوكن الموجود لا يطابق التوكن الرسمي
            if ($accessToken !== $storedToken) {
                Log::info('Invalid session token: logged out');

                session()->forget(['auth_token', 'id_token']);
                Auth::logout();

                return redirect()->route('login')
                    ->withErrors(['session_expired' => 'تم تسجيل الدخول من جهاز آخر.']);
            }

            // ✅ تحقق إضافي من صلاحية التوكن مع السيرفر الخارجي (اختياري)
            try {
                $response = $this->provider->getUserInfo($accessToken);

                if ($response->status() === 401) {
                    session()->forget(['auth_token', 'id_token']);
                    Auth::logout();

                    return redirect()->route('login')
                        ->withErrors(['session_expired' => 'انتهت الجلسة، يرجى تسجيل الدخول مجددًا.']);
                }
            } catch (\Exception $e) {
                session()->forget(['auth_token', 'id_token']);
                Auth::logout();

                return redirect()->route('login')
                    ->withErrors(['session_expired' => 'حدث خطأ في التحقق من الجلسة.']);
            }
        }

        return $next($request);
    }
}
