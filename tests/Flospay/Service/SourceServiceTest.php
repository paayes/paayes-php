<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\SourceService
 */
final class SourceServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'src_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var SourceService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SourceService($this->client);
    }

    public function testAllTransactions()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/sources/' . self::TEST_RESOURCE_ID . '/source_transactions'
        );
        $resources = $this->service->allTransactions(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SourceTransaction::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/sources'
        );
        $resource = $this->service->create([
            'type' => 'card',
        ]);
        static::assertInstanceOf(\Paayes\Source::class, $resource);
    }

    public function testDetach()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/customers/cus_123/sources/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->detach('cus_123', self::TEST_RESOURCE_ID);
        //static::assertInstanceOf(\Paayes\Source::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/sources/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Source::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/sources/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Source::class, $resource);
    }

    public function testVerify()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/sources/' . self::TEST_RESOURCE_ID . '/verify'
        );
        $resource = $this->service->verify(self::TEST_RESOURCE_ID, ['values' => [32, 45]]);
        static::assertInstanceOf(\Paayes\Source::class, $resource);
    }
}
