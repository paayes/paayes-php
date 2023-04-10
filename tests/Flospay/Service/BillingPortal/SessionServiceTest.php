<?php

namespace Paayes\Service\BillingPortal;

/**
 * @internal
 * @covers \Paayes\Service\BillingPortal\SessionService
 */
final class SessionServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'cs_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var SessionService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SessionService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/billing_portal/sessions'
        );
        $resource = $this->service->create([
            'customer' => 'cus_123',
            'return_url' => 'https://paayes.com/return',
        ]);
        static::assertInstanceOf(\Paayes\BillingPortal\Session::class, $resource);
    }
}
