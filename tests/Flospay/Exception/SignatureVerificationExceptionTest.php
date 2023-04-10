<?php

namespace Paayes\Exception;

/**
 * @internal
 * @covers \Paayes\Exception\SignatureVerificationException
 */
final class SignatureVerificationExceptionTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    public function testGetters()
    {
        $e = SignatureVerificationException::factory('message', 'payload', 'sig_header');
        static::assertSame('message', $e->getMessage());
        static::assertSame('payload', $e->getHttpBody());
        static::assertSame('sig_header', $e->getSigHeader());
    }
}
