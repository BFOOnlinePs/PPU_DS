<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\CustomIdentityServerProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $provider;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomIdentityServerProvider $provider)
    {
        $this->middleware('guest')->except('logout');
        $this->provider = $provider;
    }

    protected function authenticated(Request $request, $user)
    {
        // احذف كل الجلسات القديمة للمستخدم (ما عدا الجلسة الحالية)
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', session()->getId())
            ->get();

        foreach ($sessions as $session) {
            $sessionData = unserialize(base64_decode($session->payload));

            // تحقق إذا الجلسة تحتوي على access_token
            if (isset($sessionData['auth_token'])) {
                // إلغاء التوكن من السيرفر الخارجي
                $this->provider->revokeToken($sessionData['auth_token']);
            }
        }

        // حذف كل الجلسات القديمة
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', session()->getId())
            ->delete();

        return redirect()->intended($this->redirectTo);
    }
}
