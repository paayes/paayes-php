<?php

namespace Paayes\Checkout;

/**
 * @internal
 * @covers \Paayes\Checkout\Session
 */
final class SessionTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'cs_123';

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/checkout/sessions'
        );
        $resource = Session::create([
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

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/checkout/sessions/' . self::TEST_RESOURCE_ID
        );
        $resource = Session::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Checkout\Session::class, $resource);
    }

    public function testCanListLineItems()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/checkout/sessions/' . self::TEST_RESOURCE_ID . '/line_items'
        );
        $resources = Session::allLineItems(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\LineItem::class, $resources->data[0]);
    }
}
