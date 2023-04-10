<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\ChargeService
 */
final class ChargeServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'ch_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ChargeService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ChargeService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/charges'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Charge::class, $resources->data[0]);
    }

    public function testCapture()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/charges/' . self::TEST_RESOURCE_ID . '/capture'
        );
        $resource = $this->service->capture(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/charges'
        );
        $resource = $this->service->create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
        ]);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }
}
