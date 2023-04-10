<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Recipient
 */
final class RecipientTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'rp_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/recipients'
        );
        $resources = Recipient::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Recipient::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/recipients/' . self::TEST_RESOURCE_ID
        );
        $resource = Recipient::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Recipient::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/recipients'
        );
        $resource = Recipient::create([
            'name' => 'name',
            'type' => 'individual',
        ]);
        static::assertInstanceOf(\Paayes\Recipient::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Recipient::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/recipients/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Recipient::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/recipients/' . self::TEST_RESOURCE_ID
        );
        $resource = Recipient::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Recipient::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = Recipient::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/recipients/' . $resource->id
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\Recipient::class, $resource);
    }
}
