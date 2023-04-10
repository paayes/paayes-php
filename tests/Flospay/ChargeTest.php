<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Charge
 */
final class ChargeTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'ch_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/charges'
        );
        $resources = Charge::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Charge::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = Charge::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/charges'
        );
        $resource = Charge::create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
        ]);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Charge::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/charges/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/charges/' . self::TEST_RESOURCE_ID
        );
        $resource = Charge::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
    }

    public function testCanCapture()
    {
        $charge = Charge::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/charges/' . $charge->id . '/capture'
        );
        $resource = $charge->capture();
        static::assertInstanceOf(\Paayes\Charge::class, $resource);
        static::assertSame($resource, $charge);
    }
}
