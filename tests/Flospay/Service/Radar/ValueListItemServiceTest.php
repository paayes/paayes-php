<?php

namespace Paayes\Service\Radar;

/**
 * @internal
 * @covers \Paayes\Service\Radar\ValueListItemService
 */
final class ValueListItemServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'rsli_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ValueListItemService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ValueListItemService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_list_items'
        );
        $resources = $this->service->all([
            'value_list' => 'rsl_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_list_items'
        );
        $resource = $this->service->create([
            'value_list' => 'rsl_123',
            'value' => 'value',
        ]);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/radar/value_list_items/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resource);
        static::assertTrue($resource->isDeleted());
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_list_items/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\ValueListItem::class, $resource);
    }
}
