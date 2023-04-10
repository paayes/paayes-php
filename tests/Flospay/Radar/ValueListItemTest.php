<?php

namespace Paayes\Radar;

/**
 * @internal
 * @covers \Paayes\Radar\ValueListItem
 */
final class ValueListItemTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'rsli_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_list_items'
        );
        $resources = ValueListItem::all([
            'value_list' => 'rsl_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_list_items/' . self::TEST_RESOURCE_ID
        );
        $resource = ValueListItem::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_list_items'
        );
        $resource = ValueListItem::create([
            'value_list' => 'rsl_123',
            'value' => 'value',
        ]);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = ValueListItem::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/radar/value_list_items/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resource);
    }
}
