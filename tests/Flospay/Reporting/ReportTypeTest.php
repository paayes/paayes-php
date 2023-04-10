<?php

namespace Paayes\Reporting;

/**
 * @internal
 * @covers \Paayes\Reporting\ReportType
 */
final class ReportTypeTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'activity.summary.1';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reporting/report_types'
        );
        $resources = ReportType::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Reporting\ReportType::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reporting/report_types/' . self::TEST_RESOURCE_ID
        );
        $resource = ReportType::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Reporting\ReportType::class, $resource);
    }
}
