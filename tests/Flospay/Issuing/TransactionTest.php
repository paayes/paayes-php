<?php

namespace Paayes\Issuing;

/**
 * @internal
 * @covers \Paayes\Issuing\Transaction
 */
final class TransactionTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'ipi_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/transactions'
        );
        $resources = Transaction::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Issuing\Transaction::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/issuing/transactions/' . self::TEST_RESOURCE_ID
        );
        $resource = Transaction::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Issuing\Transaction::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Transaction::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';

        $this->expectsRequest(
            'post',
            '/api/v1/issuing/transactions/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Issuing\Transaction::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/issuing/transactions/' . self::TEST_RESOURCE_ID,
            ['metadata' => ['key' => 'value']]
        );
        $resource = Transaction::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Issuing\Transaction::class, $resource);
    }
}
