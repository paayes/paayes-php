<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\ExchangeRateService
 */
final class ExchangeRateServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ExchangeRateService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ExchangeRateService($this->client);
    }

    public function testAll()
    {
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\ExchangeRate::class, $resources->data[0]);
    }

    public function testRetrieve()
    {
        $resource = $this->service->retrieve('usd');
        static::assertInstanceOf(\Paayes\ExchangeRate::class, $resource);
    }
}
