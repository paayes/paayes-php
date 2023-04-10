<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Order
 */
final class OrderTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'or_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/orders'
        );
        $resources = Order::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Order::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/orders'
        );
        $resource = Order::create([
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . self::TEST_RESOURCE_ID
        );
        $resource = Order::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testIsPayable()
    {
        $resource = Order::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . $resource->id . '/pay'
        );
        $resource->pay();
        static::assertInstanceOf(\Paayes\Order::class, $resource);
    }

    public function testIsReturnable()
    {
        $order = Order::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/orders/' . $order->id . '/returns'
        );
        $resource = $order->returnOrder();
        static::assertInstanceOf(\Paayes\OrderReturn::class, $resource);
    }
}
