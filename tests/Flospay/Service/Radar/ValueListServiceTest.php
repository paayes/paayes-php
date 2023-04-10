<?php

namespace Paayes\Service\Radar;

/**
 * @internal
 * @covers \Paayes\Service\Radar\ValueListService
 */
final class ValueListServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'rsl_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ValueListService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ValueListService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_lists'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_lists'
        );
        $resource = $this->service->create([
            'alias' => 'alias',
            'name' => 'name',
        ]);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
        static::assertTrue($resource->isDeleted());
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/radar/value_lists/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Radar\ValueList::class, $resource);
    }
}
