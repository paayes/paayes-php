<?php

namespace Paayes\Util;

/**
 * @internal
 * @covers \Paayes\Util\ObjectTypes
 */
final class ObjectTypesTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    public function testMapping()
    {
        static::assertSame(\Paayes\Util\ObjectTypes::mapping['charge'], \Paayes\Charge::class);
        static::assertSame(\Paayes\Util\ObjectTypes::mapping['checkout.session'], \Paayes\Checkout\Session::class);
    }
}
