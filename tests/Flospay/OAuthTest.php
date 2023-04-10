<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\OAuth
 */
final class OAuthTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    public function testAuthorizeUrl()
    {
        $uriStr = OAuth::authorizeUrl([
            'scope' => 'read_write',
            'state' => 'csrf_token',
            'Paayes_user' => [
                'email' => 'test@example.com',
                'url' => 'https://example.com/profile/test',
                'country' => 'US',
            ],
        ]);

        $uri = \parse_url($uriStr);
        \parse_str($uri['query'], $params);

        static::assertSame('https', $uri['scheme']);
        static::assertSame('connect.paayes.com', $uri['host']);
        static::assertSame('/oauth/authorize', $uri['path']);

        static::assertSame('ca_123', $params['client_id']);
        static::assertSame('read_write', $params['scope']);
        static::assertSame('test@example.com', $params['Paayes_user']['email']);
        static::assertSame('https://example.com/profile/test', $params['Paayes_user']['url']);
        static::assertSame('US', $params['Paayes_user']['country']);
    }

    public function testRaisesAuthenticationErrorWhenNoClientId()
    {
        $this->expectException(\Paayes\Exception\AuthenticationException::class);
        $this->expectExceptionMessageRegExp('#No client_id provided#');

        Paayes::setClientId(null);
        OAuth::authorizeUrl();
    }

    public function testToken()
    {
        $this->stubRequest(
            'POST',
            '/oauth/token',
            [
                'grant_type' => 'authorization_code',
                'code' => 'this_is_an_authorization_code',
            ],
            null,
            false,
            [
                'access_token' => 'sk_access_token',
                'scope' => 'read_only',
                'livemode' => false,
                'token_type' => 'bearer',
                'refresh_token' => 'sk_refresh_token',
                'Paayes_user_id' => 'acct_test',
                'Paayes_publishable_key' => 'pk_test',
            ],
            200,
            Paayes::$connectBase
        );

        $resp = OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => 'this_is_an_authorization_code',
        ]);
        static::assertSame('sk_access_token', $resp->access_token);
    }

    public function testDeauthorize()
    {
        $this->stubRequest(
            'POST',
            '/oauth/deauthorize',
            [
                'Paayes_user_id' => 'acct_test_deauth',
                'client_id' => 'ca_123',
            ],
            null,
            false,
            [
                'Paayes_user_id' => 'acct_test_deauth',
            ],
            200,
            Paayes::$connectBase
        );

        $resp = OAuth::deauthorize([
            'Paayes_user_id' => 'acct_test_deauth',
        ]);
        static::assertSame('acct_test_deauth', $resp->Paayes_user_id);
    }
}
