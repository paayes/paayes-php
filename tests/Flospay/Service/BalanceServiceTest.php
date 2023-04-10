<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\BalanceService
 */
final class BalanceServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var BalanceService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new BalanceService($this->client);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/balance'
        );
        $resource = $this->service->retrieve();
        static::assertInstanceOf(\Paayes\Balance::class, $resource);
    }
}
