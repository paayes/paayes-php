<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Price
 */
final class PriceTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'price_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/prices'
        );
        $resources = Price::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Price::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/prices/' . self::TEST_RESOURCE_ID
        );
        $resource = Price::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Price::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/prices'
        );
        $resource = Price::create([
            'unit_amount' => 2000,
            'currency' => 'usd',
            'recurring' => [
                'interval' => 'month',
            ],
            'product_data' => [
                'name' => 'Product Name',
            ],
        ]);
        static::assertInstanceOf(\Paayes\Price::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Price::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/prices/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Price::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/prices/' . self::TEST_RESOURCE_ID
        );
        $resource = Price::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Price::class, $resource);
    }
}
