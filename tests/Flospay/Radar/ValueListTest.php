<?php

namespace Paayes\Radar;

/**
 * @internal
 * @covers \Paayes\Radar\ValueList
 */
final class ValueListTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'rsl_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_lists'
        );
        $resources = ValueList::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = ValueList::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_lists'
        );
        $resource = ValueList::create([
            'alias' => 'alias',
            'name' => 'name',
        ]);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = ValueList::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = ValueList::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = ValueList::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }
}
