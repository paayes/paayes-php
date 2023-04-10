<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Product
 */
final class ProductTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'prod_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/products'
        );
        $resources = Product::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Product::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/products/' . self::TEST_RESOURCE_ID
        );
        $resource = Product::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Product::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/products'
        );
        $resource = Product::create([
            'name' => 'name',
        ]);
        static::assertInstanceOf(\Paayes\Product::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Product::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/products/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Product::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/products/' . self::TEST_RESOURCE_ID
        );
        $resource = Product::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Product::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = Product::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/products/' . $resource->id
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\Product::class, $resource);
    }
}
