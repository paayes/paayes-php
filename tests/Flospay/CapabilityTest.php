<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Capability
 */
final class CapabilityTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_ACCOUNT_ID = 'acct_123';
    const TEST_RESOURCE_ID = 'acap_123';

    public function testHasCorrectUrl()
    {
        $resource = \Paayes\Account::retrieveCapability(self::TEST_ACCOUNT_ID, self::TEST_RESOURCE_ID);
        static::assertSame(
            '/api/v1/accounts/' . self::TEST_ACCOUNT_ID . '/capabilities/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }

    public function testIsNotDirectlyRetrievable()
    {
        $this->expectException(\Paayes\Exception\BadMethodCallException::class);

        Capability::retrieve(self::TEST_RESOURCE_ID);
    }

    public function testIsSaveable()
    {
        $resource = \Paayes\Account::retrieveCapability(self::TEST_ACCOUNT_ID, self::TEST_RESOURCE_ID);
        $resource->requested = true;
        $this->expectsRequest(
            'post',
            '/api/v1/accounts/' . self::TEST_ACCOUNT_ID . '/capabilities/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Capability::class, $resource);
    }

    public function testIsNotDirectlyUpdatable()
    {
        $this->expectException(\Paayes\Exception\BadMethodCallException::class);

        Capability::update(self::TEST_RESOURCE_ID, ['requested' => true]);
    }
}
