<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\CountrySpec
 */
final class CountrySpecTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'US';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/country_specs'
        );
        $resources = CountrySpec::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\CountrySpec::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/country_specs/' . self::TEST_RESOURCE_ID
        );
        $resource = CountrySpec::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\CountrySpec::class, $resource);
    }
}
