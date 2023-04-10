<?php

namespace Paayes\Service\Checkout;

/**
 * @internal
 * @covers \Paayes\Service\Checkout\SessionService
 */
final class SessionServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'cs_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var SessionService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SessionService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/checkout/sessions'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Checkout\Session::class, $resources->data[0]);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/checkout/sessions'
        );
        $resource = $this->service->create([
            'cancel_url' => 'https://paayes.com/cancel',
            'client_reference_id' => '1234',
            'line_items' => [
                [
                    'amount' => 123,
                    'currency' => 'usd',
                    'description' => 'item 1',
                    'images' => [
                        'https://paayes.com/img1',
                    ],
                    'name' => 'name',
                    'quantity' => 2,
                ],
            ],
            'payment_intent_data' => [
                'receipt_email' => 'test@paayes.com',
            ],
            'payment_method_types' => ['card'],
            'success_url' => 'https://paayes.com/success',
        ]);
        static::assertInstanceOf(\Paayes\Checkout\Session::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/checkout/sessions/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Checkout\Session::class, $resource);
    }
}
