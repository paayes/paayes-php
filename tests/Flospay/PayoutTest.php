<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Payout
 */
final class PayoutTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'po_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/payouts'
        );
        $resources = Payout::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Payout::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payouts'
        );
        $resource = Payout::create([
            'amount' => 100,
            'currency' => 'usd',
        ]);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . self::TEST_RESOURCE_ID
        );
        $resource = Payout::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testIsCancelable()
    {
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . $resource->id . '/cancel'
        );
        $resource->cancel();
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }

    public function testIsReverseable()
    {
        $resource = Payout::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/payouts/' . $resource->id . '/reverse'
        );
        $resource->reverse();
        static::assertInstanceOf(\Paayes\Payout::class, $resource);
    }
}
