<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Transfer
 */
final class TransferTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'tr_123';
    const TEST_REVERSAL_ID = 'trr_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/transfers'
        );
        $resources = Transfer::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Transfer::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/transfers/' . self::TEST_RESOURCE_ID
        );
        $resource = Transfer::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Transfer::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/transfers'
        );
        $resource = Transfer::create([
            'amount' => 100,
            'currency' => 'usd',
            'destination' => 'acct_123',
        ]);
        static::assertInstanceOf(\Paayes\Transfer::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = Transfer::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/transfers/' . $resource->id
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\Transfer::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/transfers/' . self::TEST_RESOURCE_ID
        );
        $resource = Transfer::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Transfer::class, $resource);
    }

    public function testIsCancelable()
    {
        $transfer = Transfer::retrieve(self::TEST_RESOURCE_ID);

        // Paayes-mock does not support this anymore so we stub it
        $this->stubRequest(
            'post',
            '/api/v1/transfers/' . $transfer->id . '/cancel'
        );
        $resource = $transfer->cancel();
        static::assertInstanceOf(\Paayes\Transfer::class, $resource);
        static::assertSame($resource, $transfer);
    }

    public function testCanCreateReversal()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals'
        );
        $resource = Transfer::createReversal(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\TransferReversal::class, $resource);
    }

    public function testCanRetrieveReversal()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals/' . self::TEST_REVERSAL_ID
        );
        $resource = Transfer::retrieveReversal(self::TEST_RESOURCE_ID, self::TEST_REVERSAL_ID);
        static::assertInstanceOf(\Paayes\TransferReversal::class, $resource);
    }

    public function testCanUpdateReversal()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals/' . self::TEST_REVERSAL_ID
        );
        $resource = Transfer::updateReversal(
            self::TEST_RESOURCE_ID,
            self::TEST_REVERSAL_ID,
            [
                'metadata' => ['key' => 'value'],
            ]
        );
        static::assertInstanceOf(\Paayes\TransferReversal::class, $resource);
    }

    public function testCanListReversal()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/transfers/' . self::TEST_RESOURCE_ID . '/reversals'
        );
        $resources = Transfer::allReversals(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\TransferReversal::class, $resources->data[0]);
    }
}
