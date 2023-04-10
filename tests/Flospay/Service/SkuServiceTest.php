<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\SkuService
 */
final class SkuServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'sku_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var SkuService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SkuService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/skus'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SKU::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/skus'
        );
        $resource = $this->service->create([
            'currency' => 'usd',
            'inventory' => [
                'type' => 'finite',
                'quantity' => 1,
            ],
            'price' => 100,
            'product' => 'prod_123',
        ]);
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/skus/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
        static::assertTrue($resource->isDeleted());
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/skus/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/skus/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }
}
