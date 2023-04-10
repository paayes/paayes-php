<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Review
 */
final class ReviewTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'prv_123';

    public function testIsApprovable()
    {
        $resource = Review::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/api/v1/reviews/' . self::TEST_RESOURCE_ID . '/approve'
        );
        $resource->approve();
        static::assertInstanceOf(\Paayes\Review::class, $resource);
    }

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reviews'
        );
        $resources = Review::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Review::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/reviews/' . self::TEST_RESOURCE_ID
        );
        $resource = Review::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Review::class, $resource);
    }
}
