<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\TokenService
 */
final class TokenServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    const TEST_RESOURCE_ID = 'tok_123';

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var TokenService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new TokenService($this->client);
    }

    public function testCreate()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/tokens'
        );
        $resource = $this->service->create(['card' => 'tok_visa']);
        static::assertInstanceOf(\Paayes\Token::class, $resource);
    }

    public function testRetrieve()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/tokens/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\Token::class, $resource);
    }
}
