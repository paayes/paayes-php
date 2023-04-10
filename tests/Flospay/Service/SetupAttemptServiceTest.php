<?php

namespace Paayes\Service;

/**
 * @internal
 * @covers \Paayes\Service\SetupAttemptService
 */
final class SetupAttemptServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Paayes\TestHelper;

    /** @var \Paayes\PaayesClient */
    private $client;

    /** @var SetupAttemptService */
    private $service;

    /**
     * @before
     */
    protected function setUpService()
    {
        $this->client = new \Paayes\PaayesClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SetupAttemptService($this->client);
    }

    public function testAll()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/setup_attempts'
        );
        $resources = $this->service->all([
            'setup_intent' => 'si_123',
        ]);
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\SetupAttempt::class, $resources->data[0]);
    }
}
