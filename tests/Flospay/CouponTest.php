<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Coupon
 */
final class CouponTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = '25OFF';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/coupons'
        );
        $resources = Coupon::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Coupon::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource = Coupon::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Coupon::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/coupons'
        );
        $resource = Coupon::create([
            'percent_off' => 25,
            'duration' => 'repeating',
            'duration_in_months' => 3,
            'id' => self::TEST_RESOURCE_ID,
        ]);
        static::assertInstanceOf(\Paayes\Coupon::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Coupon::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Coupon::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource = Coupon::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Coupon::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = Coupon::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/coupons/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertInstanceOf(\Paayes\Coupon::class, $resource);
    }
}
