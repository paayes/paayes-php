<?php

namespace Paayes\Service\Terminal;

/**
 * @internal
 * @covers \Paayes\Service\Terminal\LocationService
 */
final class LocationServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'tml_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var LocationService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new LocationService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/terminal/locations'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Terminal\Location::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/terminal/locations',
            [
                'display_name' => 'name',
                'address' => [
                    'line1' => 'line1',
                    'country' => 'US',
                    'state' => 'CA',
                    'postal_code' => '12345',
                    'city' => 'San Francisco',
                ],
            ]
        );
        $resource = $this->service->create(
            [
                'display_name' => 'name',
                'address' => [
                    'line1' => 'line1',
                    'country' => 'US',
                    'state' => 'CA',
                    'postal_code' => '12345',
                    'city' => 'San Francisco',
                ],
            ]
        );
        static::assertInstanceOf(\Paayes\Terminal\Location::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/terminal/locations/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Terminal\Location::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/terminal/locations/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Terminal\Location::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/terminal/locations/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Terminal\Location::class, $resource);
    }
}
