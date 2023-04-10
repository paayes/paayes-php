<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Mandate
 */
final class MandateTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'mandate_123';

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/mandates/' . self::TEST_RESOURCE_ID
        );
        $resource = Mandate::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Mandate::class, $resource);
    }
}
