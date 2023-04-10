<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\PaayesClient
 */
final class PaayesClientTest extends \PHPUnit\Framework\TestCase
{
    public function testExposesPropertiesForServices()
    {
        $client = new PaayesClient('sk_test_123');
        static::assertInstanceOf(\Paayes\Service\CouponService::class, $client->coupons);
        static::assertInstanceOf(\Paayes\Service\Issuing\IssuingServiceFactory::class, $client->issuing);
        static::assertInstanceOf(\Paayes\Service\Issuing\CardService::class, $client->issuing->cards);
    }
}
