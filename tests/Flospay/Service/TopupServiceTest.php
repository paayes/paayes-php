<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\TopupService
 */
final class TopupServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'tu_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var TopupService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new TopupService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/topups'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Topup::class, $resources->data[0]);
    }

    public function testCancel()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/topups/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/topups'
        );
        $resource = $this->service->create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_123',
            'description' => 'description',
            'statement_descriptor' => 'statement descriptor',
        ]);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/topups/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/topups/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Topup::class, $resource);
    }
}
