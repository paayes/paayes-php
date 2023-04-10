<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\TaxRate
 */
final class TaxRateTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'txr_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/tax_rates'
        );
        $resources = TaxRate::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\TaxRate::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/tax_rates/' . self::TEST_RESOURCE_ID
        );
        $resource = TaxRate::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\TaxRate::class, $resource);
    }

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/tax_rates'
        );
        $resource = TaxRate::create([
            'display_name' => 'name',
            'inclusive' => false,
            'percentage' => 10.15,
        ]);
        static::assertInstanceOf(\Paayes\TaxRate::class, $resource);
    }

    public function testIsSaveable()
    {
        $resource = TaxRate::retrieve(self::TEST_RESOURCE_ID);
        $resource->metadata['key'] = 'value';
        $this->expectsRequest(
            'post',
            '/api/v1/tax_rates/' . self::TEST_RESOURCE_ID
        );
        $resource->save();
        static::assertInstanceOf(\Paayes\TaxRate::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/tax_rates/' . self::TEST_RESOURCE_ID
        );
        $resource = TaxRate::update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\TaxRate::class, $resource);
    }
}
