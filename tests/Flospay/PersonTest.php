<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Person
 */
final class PersonTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_ACCOUNT_ID = 'acct_123';
    const TEST_RESOURCE_ID = 'person_123';

    public function testHasCorrectUrl()
    {
        $resource = \Paayes\Account::retrievePerson(self::TEST_ACCOUNT_ID, self::TEST_RESOURCE_ID);
        static::assertSame(
            '/api/v1/accounts/' . self::TEST_ACCOUNT_ID . '/persons/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }

    public function testIsNotDirectlyRetrievable()
    {
        $this->expectException(\Paayes\Exception\BadMethodCallException::class);

        Person::retrieve(self::TEST_RESOURCE_ID);
    }

    public function testIsSaveable()
    {
        $resource = \Paayes\Account::retrievePerson(self::TEST_ACCOUNT_ID, self::TEST_RESOURCE_ID);
        $resource->first_name = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/accounts/' . self::TEST_ACCOUNT_ID . '/persons/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertSame(\Paayes\Person::class, \get_class($resource));
    }

    public function testIsNotDirectlyUpdatable()
    {
        $this->expectException(\Paayes\Exception\BadMethodCallException::class);

        Person::update(self::TEST_RESOURCE_ID, [
            'first_name' => ['John'],
        ]);
    }

    public function testIsDeletable()
    {
        $resource = \Paayes\Account::retrievePerson(self::TEST_ACCOUNT_ID, self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/api/v1/accounts/' . self::TEST_ACCOUNT_ID . '/persons/' . self::TEST_RESOURCE_ID
        );
        $resource->delete();
        static::assertSame(\Paayes\Person::class, \get_class($resource));
    }
}
