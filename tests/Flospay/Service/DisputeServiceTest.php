<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\DisputeService
 */
final class DisputeServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'dp_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var DisputeService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new DisputeService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/disputes'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Dispute::class, $resources->data[0]);
    }

    public function testClose()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/disputes/' . self::TEST_RESOURCE_ID . '/close'
        );
        $resource = $this->service->close(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Dispute::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/disputes/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Dispute::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/disputes/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Dispute::class, $resource);
    }
}
