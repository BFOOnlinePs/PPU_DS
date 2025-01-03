<?php
namespace App\Services;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class CustomIdentityServerProvider extends AbstractProvider
{
    /**
     * النطاقات الافتراضية.
     */
    protected $scopes = ['openid', 'profile', 'email', 'offline_access'];

    /**
     * بناء رابط التوجيه إلى صفحة تسجيل الدخول.
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('services.identity_server.url') . '/connect/authorize', $state);
    }

    /**
     * رابط الحصول على رمز التوثيق (Token).
     */
    protected function getTokenUrl()
    {
        return config('services.identity_server.url') . '/connect/token';
    }

    /**
     * جلب معلومات المستخدم باستخدام رمز التوثيق.
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(config('services.identity_server.url') . '/connect/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * تحويل بيانات المستخدم إلى كائن User.
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['sub'] ?? null,
            'name' => $user['name'] ?? null,
            'email' => $user['email'] ?? null,
            'avatar' => $user['picture'] ?? null,
        ]);
    }
}
?>
