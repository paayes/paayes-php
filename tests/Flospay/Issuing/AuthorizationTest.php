<?php

namespace Paayes\Issuing;

/**
 * @internal
 * @covers \Paayes\Issuing\Authorization
 */
final class AuthorizationTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'iauth_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/authorizations'
        );
        $resources = Authorization::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID
        );
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';

        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID,
            ['metadata' => ['key' => 'value']]
        );
        $resource = Authorization::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testIsApprovable()
    {
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);

        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/approve'
        );
        $resource = $resource->approve();
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }

    public function testIsDeclinable()
    {
        $resource = Authorization::retrieve(self::TEST_RESOURCE_ID);

        $this->expectsRequest(
            'post',
            '/api/v1/issuing/authorizations/' . self::TEST_RESOURCE_ID . '/decline'
        );
        $resource = $resource->decline();
        static::assertInstanceOf(\Paayes\Issuing\Authorization::class, $resource);
    }
}
