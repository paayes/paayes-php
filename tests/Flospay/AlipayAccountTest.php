<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\AlipayAccount
 */
final class AlipayAccountTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'aliacc_123';

    // Because of the wildcard nature of sources, Paayes-mock cannot currently
    // reliably return sources of a given type, so we create a fixture manually
    public function createFixture($params = [])
    {
        if (empty($params)) {
            $params['customer'] = 'cus_123';
        }
        $base = [
            'id' => self::TEST_RESOURCE_ID,
            'object' => 'card',
            'metadata' => [],
        ];

        return AlipayAccount::constructFrom(
            \array_merge($params, $base),
            new Util\RequestOptions()
        );
    }

    public function testHasCorrectUrlForCustomer()
    {
        $resource = $this->createFixture(['customer' => 'cus_123']);
        static::assertSame(
            '/api/v1/customers/cus_123/sources/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }

    public function testIsNotDirectlyRetrievable()
    {
        $this->expectException(\Paayes\Exception\BadMethodCallException::class);

        AlipayAccount::retrieve(self::TEST_RESOURCE_ID);
    }

    public function testIsSaveable()
    {
        $resource = $this->createFixture();
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/customers/cus_123/sources/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertSame(\Paayes\AlipayAccount::class, \get_class($resource));
    }

    public function testIsNotDirectlyUpdatable()
    {
        $this->expectException(\Paayes\Exception\BadMethodCallException::class);

        AlipayAccount::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
    }

    public function testIsDeletable()
    {
        $resource = $this->createFixture();
        $this->expectsRequest(
            'delete',
            '/api/v1/customers/cus_123/sources/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertSame(\Paayes\AlipayAccount::class, \get_class($resource));
    }
}
