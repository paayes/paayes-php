<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\SubscriptionScheduleService
 */
final class SubscriptionScheduleServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'sub_sched_123';
    const TEST_REVISION_ID = 'sub_sched_rev_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var SubscriptionScheduleService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SubscriptionScheduleService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_schedules'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resources->data[0]);
    }

    public function testCancel()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules'
        );
        $resource = $this->service->create([
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

    public function testRelease()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . self::TEST_RESOURCE_ID . '/release'
        );
        $resource = $this->service->release(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\SubscriptionSchedule::class, $resource);
    }
}
