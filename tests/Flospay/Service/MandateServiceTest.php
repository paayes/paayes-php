<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\MandateService
 */
final class MandateServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'mandate_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var MandateService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new MandateService($this->client);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/mandates/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Mandate::class, $resource);
    }
}
