<?php

namespace Paayes\Service\Terminal;

/**
 * @internal
 * @covers \Paayes\Service\Terminal\ReaderService
 */
final class ReaderServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'tml_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ReaderService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ReaderService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/terminal/readers'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Terminal\Reader::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/terminal/readers',
            ['registration_code' => 'a-b-c']
        );
        $resource = $this->service->create(['registration_code' => 'a-b-c']);
        static::assertInstanceOf(\Paayes\Terminal\Reader::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/terminal/readers/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Terminal\Reader::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/terminal/readers/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Terminal\Reader::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/terminal/readers/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Terminal\Reader::class, $resource);
    }
}
