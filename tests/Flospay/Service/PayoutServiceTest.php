<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\PayoutService
 */
final class PayoutServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'po_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var PayoutService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new PayoutService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/payouts'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Payout::class, $resources->data[0]);
    }

    public function testCancel()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payouts'
        );
        $resource = $this->service->create([
            'amount' => 100,
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testReverse()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . self::TEST_RESOURCE_ID . '/reverse'
        );
        $resource = $this->service->reverse(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }
}
