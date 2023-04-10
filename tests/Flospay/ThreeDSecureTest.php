<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\ThreeDSecure
 */
final class ThreeDSecureTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'tdsrc_123';

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/3d_secure/' . self::TEST_RESOURCE_ID
        );
        $resource = ThreeDSecure::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\ThreeDSecure::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/3d_secure'
        );
        $resource = ThreeDSecure::create([
            'amount' => 100,
            'currency' => 'usd',
            'return_url' => 'url',
        ]);
        static::assertInstanceOf(\Paayes\ThreeDSecure::class, $resource);
    }
}
