<?php

namespace Paayes\Service\Reporting;

/**
 * @internal
 * @covers \Paayes\Service\Reporting\ReportRunService
 */
final class ReportRunServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'frr_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ReportRunService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ReportRunService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reporting/report_runs'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Reporting\ReportRun::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $params = [
            'parameters' => [
                'connected_account' => 'acct_123',
            ],
            'report_type' => 'activity.summary.1',
        ];

        $this->expectsRequest(
            'post',
            '/api/v1/reporting/report_runs',
            $params
        );
        $resource = $this->service->create($params);
        static::assertInstanceOf(\Paayes\Reporting\ReportRun::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reporting/report_runs/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Reporting\ReportRun::class, $resource);
    }
}
