<?php

namespace Paayes\Identity;

/**
 * @internal
 * @coversNothing
 */
final class VerificationReportTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;
    const TEST_RESOURCE_ID = 'vr_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/identity/verification_reports'
        );
        $resources = VerificationReport::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Identity\VerificationReport::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/identity/verification_reports/' . self::TEST_RESOURCE_ID
        );
        $resource = VerificationReport::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Identity\VerificationReport::class, $resource);
    }
}
