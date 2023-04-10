<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\SubscriptionSchedule
 */
final class SubscriptionScheduleTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'sub_sched_123';
    const TEST_REVISION_ID = 'sub_sched_rev_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_schedules'
        );
        $resources = SubscriptionSchedule::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules'
        );
        $resource = SubscriptionSchedule::create([
            'phases' => [
                [
                    'items' => [
                        ['price' => 'price_123', 'quantity' => 2],
                    ],
                ],
            ],
        ]);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = SubscriptionSchedule::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testIsCancelable()
    {
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . $resource->id . '/cancel',
            []
        );
        $resource->cancel([]);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testIsReleaseable()
    {
        $resource = SubscriptionSchedule::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . $resource->id . '/release',
            []
        );
        $resource->release([]);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }
}
