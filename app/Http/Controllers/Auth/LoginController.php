<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\CustomIdentityServerProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        $this->provider->revokeToken($request->session()->get('auth_token')->getToken());
        $request->session()->forget('auth_token');
        return redirect()->route('login');
    }
}
