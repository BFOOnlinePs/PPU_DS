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
        $response = Http::withToken($accessToken)->get($this->provider->getResourceOwnerDetailsUrl($accessToken));
        return $response->json();
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
