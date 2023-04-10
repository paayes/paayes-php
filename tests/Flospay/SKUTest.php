<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\SKU
 */
final class SKUTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'sku_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/skus'
        );
        $resources = SKU::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SKU::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/skus/' . self::TEST_RESOURCE_ID
        );
        $resource = SKU::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/skus'
        );
        $resource = SKU::create([
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

    public function testIsSaveable()
    {
        $resource = SKU::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/skus/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/skus/' . self::TEST_RESOURCE_ID
        );
        $resource = SKU::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = SKU::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/skus/' . $resource->id
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\SKU::class, $resource);
    }
}
