<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Topup
 */
final class TopupTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'tu_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/topups'
        );
        $resources = Topup::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Topup::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/topups/' . self::TEST_RESOURCE_ID
        );
        $resource = Topup::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/topups'
        );
        $resource = Topup::create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
            'description' => 'description',
            'statement_descriptor' => 'statement descriptor',
        ]);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Topup::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/topups/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/topups/' . self::TEST_RESOURCE_ID
        );
        $resource = Topup::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testIsCancelable()
    {
        $resource = Topup::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/topups/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $resource->cancel();
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }
}
