<?php

namespace Paayes\BillingPortal;

/**
 * @internal
 * @covers \Paayes\BillingPortal\Session
 */
final class SessionTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'pts_123';

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/billing_portal/sessions'
        );
        $resource = Session::create([
            'customer' => 'cus_123',
            'return_url' => 'https://paayes.com/return',
        ]);
        static::assertInstanceOf(\Paayes\BillingPortal\Session::class, $resource);
    }
}
