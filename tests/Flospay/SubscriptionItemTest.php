<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\SubscriptionItem
 */
final class SubscriptionItemTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'si_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_items',
            [
                'subscription' => 'sub_123',
            ]
        );
        $resources = SubscriptionItem::all([
            'subscription' => 'sub_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SubscriptionItem::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_items/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SubscriptionItem::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_items'
        );
        $resource = SubscriptionItem::create([
            'price' => 'price_123',
            'subscription' => 'sub_123',
        ]);
        static::assertInstanceOf(\Paayes\SubscriptionItem::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_items/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\SubscriptionItem::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_items/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionItem::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\SubscriptionItem::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/subscription_items/' . $resource->id
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\SubscriptionItem::class, $resource);
    }

    public function testCanCreateUsageRecord()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_items/' . self::TEST_RESOURCE_ID . '/usage_records'
        );
        $resource = SubscriptionItem::createUsageRecord(self::TEST_RESOURCE_ID, [
            'quantity' => 100,
            'timestamp' => 12341234,
            'action' => 'set',
        ]);
    }

    public function testCanListUsageRecordSummariesDeprecated()
    {
        $resource = SubscriptionItem::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_items/' . $resource->id . '/usage_record_summaries'
        );
        $resources = $resource->usageRecordSummaries();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\UsageRecordSummary::class, $resources->data[0]);
    }

    public function testCanListUsageRecordSummaries()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_items/' . self::TEST_RESOURCE_ID . '/usage_record_summaries'
        );
        $resources = SubscriptionItem::allUsageRecordSummaries(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\UsageRecordSummary::class, $resources->data[0]);
    }
}
