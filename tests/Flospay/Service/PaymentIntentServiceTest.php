<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\PaymentIntentService
 */
final class PaymentIntentServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'pi_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var PaymentIntentService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new PaymentIntentService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/payment_intents'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resources->data[0]);
    }

    public function testCancel()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payment_intents/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resource);
    }

    public function testCapture()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payment_intents/' . self::TEST_RESOURCE_ID . '/capture'
        );
        $resource = $this->service->capture(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resource);
    }

    public function testConfirm()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payment_intents/' . self::TEST_RESOURCE_ID . '/confirm'
        );
        $resource = $this->service->confirm(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resource);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payment_intents'
        );
        $resource = $this->service->create([
            'amount' => 100,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/payment_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resource);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/payment_intents/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\PaymentIntent::class, $resource);
    }
}
