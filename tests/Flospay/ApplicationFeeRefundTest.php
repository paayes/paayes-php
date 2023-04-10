<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\ApplicationFeeRefund
 */
final class ApplicationFeeRefundTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'fr_123';
    const TEST_FEE_ID = 'fee_123';

    public function testIsSaveable()
    {
        $resource = ApplicationFee::retrieveRefund(self::TEST_FEE_ID, self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/application_fees/' . $resource->fee . '/refunds/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\ApplicationFeeRefund::class, $resource);
    }
}
