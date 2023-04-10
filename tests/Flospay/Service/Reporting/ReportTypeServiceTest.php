<?php

namespace Paayes\Service\Reporting;

/**
 * @internal
 * @covers \Paayes\Service\Reporting\ReportTypeService
 */
final class ReportTypeServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'activity.summary.1';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ReportTypeService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ReportTypeService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reporting/report_types'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Reporting\ReportType::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reporting/report_types/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Reporting\ReportType::class, $resource);
    }
}
