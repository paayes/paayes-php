<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\InvoiceService
 */
final class InvoiceServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'in_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var InvoiceService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new InvoiceService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/invoices'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\Invoice::class, $resources->data[0]);
    }

    public function testAllLines()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID . '/lines'
        );
        $resources = $this->service->allLines(self::TEST_RESOURCE_ID);
        static::assertInternalType('array', $resources->data);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices'
        );
        $resource = $this->service->create([
            'customer' => 'cus_123',
        ]);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testDelete()
    {
        $this->expectsRequest(
            'delete',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->delete(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testFinalizeInvoice()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID . '/finalize'
        );
        $resource = $this->service->finalizeInvoice(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testMarkUncollectible()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID . '/mark_uncollectible'
        );
        $resource = $this->service->markUncollectible(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testPay()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID . '/pay'
        );
        $resource = $this->service->pay(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testSendInvoice()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID . '/send'
        );
        $resource = $this->service->sendInvoice(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testUpcoming()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/invoices/upcoming'
        );
        $resource = $this->service->upcoming(['customer' => 'cus_123']);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testUpcomingLines()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/invoices/upcoming/lines'
        );
        $resources = $this->service->upcomingLines();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\InvoiceLineItem::class, $resources->data[0]);
    }

    public function testUpdate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }

    public function testVoidInvoice()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/invoices/' . self::TEST_RESOURCE_ID . '/void'
        );
        $resource = $this->service->voidInvoice(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Invoice::class, $resource);
    }
}
