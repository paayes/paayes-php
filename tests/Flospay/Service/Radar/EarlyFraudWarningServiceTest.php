<?php

namespace Paayes\Service\Radar;

/**
 * @internal
 * @covers \Paayes\Service\Radar\EarlyFraudWarningService
 */
final class EarlyFraudWarningServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'issfr_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var EarlyFraudWarningService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new EarlyFraudWarningService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/early_fraud_warnings'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Radar\EarlyFraudWarning::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/radar/early_fraud_warnings/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Radar\EarlyFraudWarning::class, $resource);
    }
}
