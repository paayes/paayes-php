<?php

namespace Paayes\Service\Identity;

/**
 * @internal
 * @covers \Paayes\Service\Identity\VerificationReportService
 */
final class VerificationReportServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'vr_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var VerificationReportService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new VerificationReportService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/identity/verification_reports'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Identity\VerificationReport::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/identity/verification_reports/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Identity\VerificationReport::class, $resource);
    }
}
