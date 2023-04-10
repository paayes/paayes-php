<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\WebhookEndpointService
 */
final class WebhookEndpointServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'we_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var WebhookEndpointService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new WebhookEndpointService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/webhook_endpoints'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\WebhookEndpoint::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/webhook_endpoints'
        );
        $resource = $this->service->create([
            'enabled_events' => ['charge.succeeded'],
            'url' => 'https://paayes.com',
        ]);
        static::assertInstanceOf(\Paayes\WebhookEndpoint::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\WebhookEndpoint::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\WebhookEndpoint::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/webhook_endpoints/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'enabled_events' => ['charge.succeeded'],
        ]);
        static::assertInstanceOf(\Paayes\WebhookEndpoint::class, $resource);
    }
}
