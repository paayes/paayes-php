<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\OrderService
 */
final class OrderServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'or_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var OrderService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new OrderService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/orders'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Order::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/orders'
        );
        $resource = $this->service->create([
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testPay()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . self::TEST_RESOURCE_ID . '/pay'
        );
        $resource = $this->service->pay(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testReturnOrder()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . self::TEST_RESOURCE_ID . '/returns'
        );
        $resource = $this->service->returnOrder(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\OrderReturn::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }
}
