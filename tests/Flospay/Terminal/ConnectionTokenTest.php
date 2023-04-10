<?php

namespace Paayes\Terminal;

/**
 * @internal
 * @covers \Paayes\Terminal\ConnectionToken
 */
final class ConnectionTokenTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/terminal/connection_tokens'
        );
        $resource = ConnectionToken::create();
        static::assertInstanceOf(\Paayes\Terminal\ConnectionToken::class, $resource);
    }
}
