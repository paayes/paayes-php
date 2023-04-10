<?php

namespace Paayes\Service\Issuing;

/**
 * @internal
 * @covers \Paayes\Service\Issuing\CardholderService
 */
final class CardholderServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'ich_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var CardholderService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new CardholderService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/cardholders'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Issuing\Cardholder::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $params = [
            'billing' => [
                'address' => [
                    'city' => 'city',
                    'country' => 'US',
                    'line1' => 'line1',
                    'postal_code' => 'postal_code',
                ],
            ],
            'name' => 'Cardholder Name',
            'type' => 'individual',
        ];

        $this->expectsRequest(
            'post',
            '/api/v1/issuing/cardholders',
            $params
        );
        $resource = $this->service->create($params);
        static::assertInstanceOf(\Paayes\Issuing\Cardholder::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/cardholders/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Issuing\Cardholder::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/issuing/cardholders/' . self::TEST_RESOURCE_ID,
            ['metadata' => ['key' => 'value']]
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Issuing\Cardholder::class, $resource);
    }
}
