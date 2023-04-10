<?php

namespace Paayes\Exception\OAuth;

/**
 * @internal
 * @covers \Paayes\Exception\OAuth\OAuthErrorException
 */
final class OAuthErrorExceptionTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    public function createFixture()
    {
        $mock = $this->getMockForAbstractClass(OAuthErrorException::class);

        return $mock::factory(
            'description',
            200,
            '{"error": "code", "error_description": "description"}',
            ['error' => 'code', 'error_description' => 'description'],
            [
                'Some-Header' => 'Some Value',
                'Request-Id' => 'req_test',
            ],
            'code'
        );
    }

    public function testGetters()
    {
        $e = $this->createFixture();
        static::assertSame(200, $e->getHttpStatus());
        static::assertSame('{"error": "code", "error_description": "description"}', $e->getHttpBody());
        static::assertSame(['error' => 'code', 'error_description' => 'description'], $e->getJsonBody());
        static::assertSame('Some Value', $e->getHttpHeaders()['Some-Header']);
        static::assertSame('req_test', $e->getRequestId());
        static::assertSame('code', $e->getPaayesCode());
        static::assertNotNull($e->getError());
        static::assertSame('code', $e->getError()->error);
        static::assertSame('description', $e->getError()->error_description);
    }

    public function testToString()
    {
        $e = $this->createFixture();
        static::assertContains('(Request req_test)', (string) $e);
    }
}
