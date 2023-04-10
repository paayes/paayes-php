<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\CustomerBalanceTransaction
 */
final class CustomerBalanceTransactionTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_CUSTOMER_ID = 'cus_123';
    const TEST_RESOURCE_ID = 'cbtxn_123';

    public function testHasCorrectUrl()
    {
        $resource = \Paayes\Customer::retrieveBalanceTransaction(self::TEST_CUSTOMER_ID, self::TEST_RESOURCE_ID);
        static::assertSame(
            '/api/v1/customers/' . self::TEST_CUSTOMER_ID . '/balance_transactions/' . self::TEST_RESOURCE_ID,
            $resource->instanceUrl()
        );
    }
}
