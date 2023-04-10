<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\AccountLinkService
 */
final class AccountLinkServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var AccountLinkService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new AccountLinkService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/account_links'
        );
        $resource = $this->service->create([
            'account' => 'acct_123',
            'refresh_url' => 'https://paayes.com/refresh_url',
            'return_url' => 'https://paayes.com/return_url',
            'type' => 'account_onboarding',
        ]);
        static::assertInstanceOf(\Paayes\AccountLink::class, $resource);
    }
}
