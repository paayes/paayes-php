<?php

namespace Paayes\Service\Terminal;

/**
 * @internal
 * @covers \Paayes\Service\Terminal\ConnectionTokenService
 */
final class ConnectionTokenServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var ConnectionTokenService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new ConnectionTokenService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/terminal/connection_tokens'
        );
        $resource = $this->service->create();
        static::assertInstanceOf(\Paayes\Terminal\ConnectionToken::class, $resource);
    }
}
