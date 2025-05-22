<?php

namespace App\Services;

use League\OAuth2\Client\Provider\GenericProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomIdentityServerProvider
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new GenericProvider([
            'clientId'                => env('CLIENT_ID'),
            'clientSecret'            => env('CLIENT_SECRET'),
            'redirectUri'             => env('REDIRECT_URI'),
            'urlAuthorize'            => env('IDENTITY_SERVER_URL') . '/connect/authorize',
            'urlAccessToken'          => env('IDENTITY_SERVER_URL') . '/connect/token',
            'urlResourceOwnerDetails' => env('IDENTITY_SERVER_URL') . '/connect/userinfo',
            'scopes'                  => "openid profile email offline_access role userno ExternalApis.api",
        ]);
    }

    public function getAuthorizationUrl()
    {
        return $this->provider->getAuthorizationUrl();
    }

    public function getAccessToken($code)
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);
    }

    public function getUserInfo($accessToken)
    {


        $response = Http::withToken($accessToken)->get('https://my.ppu.edu/connect/userinfo');


        // dd($response);
        $user_role = $response->json('role');
        $user_id = $response->json('sub');



        return $response;
    }

    public function revokeToken($accessToken)
    {
        $response = Http::asForm()->post(env('IDENTITY_SERVER_URL') . '/connect/revocation', [
            'token' => $accessToken,
            'token_type_hint' => 'access_token',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
        ]);

        Log::info('Revocation response: ' . $response->body());

        return $response->ok();
    }

    public function getLogoutUrl()
    {
        // Get the ID token from the session if available
        $idToken = session('id_token');

        // Build the logout URL with required parameters
        $logoutUrl = env('IDENTITY_SERVER_URL') . '/connect/endsession';

        // Add required parameters
        $params = [
            'id_token_hint' => $idToken,
            'post_logout_redirect_uri' => env('REDIRECT_URI'),
            'client_id' => env('CLIENT_ID')
        ];

        // Return the complete logout URL with parameters
        return $logoutUrl . '?' . http_build_query($params);
    }

    public function getMajors($accessToken)
    {
        $response = Http::withToken($accessToken)->get(env('DOMAIN') . '/api/DualStudies/getAllDSMajors');
        return $response;
    }

    public function getAllCities($accessToken)
    {
        $response = Http::withToken($accessToken)->get(env('DOMAIN') . '/api/DualStudies/getAllCities');
        return $response;
    }

    public function getDsStudentsByYear($accessToken, $academicYear, $semester)
    {
        $response = Http::withToken($accessToken)->get(env('DOMAIN') . '/api/DualStudies/getDsStudentsByYear/' . $academicYear . '/' . $semester);
        return $response;
    }
}
