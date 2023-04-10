<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\EphemeralKeyService
 */
final class EphemeralKeyServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'ek_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var EphemeralKeyService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new EphemeralKeyService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/ephemeral_keys',
            null,
            ['Paayes-Version: 2017-05-25']
        );
        $resource = $this->service->create([
            'customer' => 'cus_123',
        ], ['Paayes_version' => '2017-05-25']);
        static::assertInstanceOf(\Paayes\EphemeralKey::class, $resource);
    }

    public function testCreateWithoutExplicitApiVersion()
    {
        $this->expectException(\InvalidArgumentException::class);

        $resource = $this->service->create([
            'customer' => 'cus_123',
        ]);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/ephemeral_keys/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\EphemeralKey::class, $resource);
    }
}
