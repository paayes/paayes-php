<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\ApplicationFee
 */
final class ApplicationFeeTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'fee_123';
    const TEST_FEEREFUND_ID = 'fr_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/application_fees'
        );
        $resources = ApplicationFee::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\ApplicationFee::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/application_fees/' . self::TEST_RESOURCE_ID
        );
        $resource = ApplicationFee::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\ApplicationFee::class, $resource);
    }

    public function testCanCreateRefund()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/application_fees/' . self::TEST_RESOURCE_ID . '/refunds'
        );
        $resource = ApplicationFee::createRefund(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\ApplicationFeeRefund::class, $resource);
    }

    public function testCanRetrieveRefund()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/application_fees/' . self::TEST_RESOURCE_ID . '/refunds/' . self::TEST_FEEREFUND_ID
        );
        $resource = ApplicationFee::retrieveRefund(self::TEST_RESOURCE_ID, self::TEST_FEEREFUND_ID);
        static::assertInstanceOf(\Paayes\ApplicationFeeRefund::class, $resource);
    }

    public function testCanUpdateRefund()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/application_fees/' . self::TEST_RESOURCE_ID . '/refunds/' . self::TEST_FEEREFUND_ID
        );
        $resource = ApplicationFee::updateRefund(self::TEST_RESOURCE_ID, self::TEST_FEEREFUND_ID);
        static::assertInstanceOf(\Paayes\ApplicationFeeRefund::class, $resource);
    }

    public function testCanListRefunds()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/application_fees/' . self::TEST_RESOURCE_ID . '/refunds'
        );
        $resources = ApplicationFee::allRefunds(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\ApplicationFeeRefund::class, $resources->data[0]);
    }
}
