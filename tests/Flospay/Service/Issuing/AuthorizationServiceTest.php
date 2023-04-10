<?php

namespace Paayes\Service\Issuing;

/**
 * @internal
 * @covers \Paayes\Service\Issuing\AuthorizationService
 */
final class AuthorizationServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'iauth_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var AuthorizationService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new AuthorizationService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/authorizations'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resources->data[0]);
    }

    public function testApprove()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/approve'
        );
        $resource = $this->service->approve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testDecline()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/decline'
        );
        $resource = $this->service->decline(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID,
            ['metadata' => ['key' => 'value']]
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }
}
