<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Token
 */
final class TokenTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'tok_123';

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/tokens/' . self::TEST_RESOURCE_ID
        );
        $resource = Token::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Token::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/tokens'
        );
        $resource = Token::create(['card' => 'tok_visa']);
        static::assertInstanceOf(\Paayes\Token::class, $resource);
    }
}
