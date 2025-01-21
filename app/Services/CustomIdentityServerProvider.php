<?php

namespace App\Services;

use League\OAuth2\Client\Provider\GenericProvider;
use Illuminate\Support\Facades\Http;

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
            'scopes'                  => explode(' ', env('SCOPES')),
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
        $response = Http::withToken($accessToken)->get($this->provider->getResourceOwnerDetailsUrl());
        return $response->json();
    }
}
