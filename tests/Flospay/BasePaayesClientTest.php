<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\BasePaayesClient
 */
final class BasePaayesClientTest extends \PHPUnit\Framework\TestCase
{
    /** @var \ReflectionProperty */
    private $optsReflector;

    /** @before */
    protected function setUpOptsReflector()
    {
        $this->optsReflector = new \ReflectionProperty(\Paayes\PaayesObject::class, '_opts');
        $this->optsReflector->setAccessible(true);
    }

    public function testCtorDoesNotThrowWhenNoParams()
    {
        $client = new BasePaayesClient();
        static::assertNotNull($client);
        static::assertNull($client->getApiKey());
    }

    public function testCtorThrowsIfConfigIsUnexpectedType()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('$config must be a string or an array');

        $client = new BasePaayesClient(234);
    }

    public function testCtorThrowsIfApiKeyIsEmpty()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('api_key cannot be the empty string');

        $client = new BasePaayesClient('');
    }

    public function testCtorThrowsIfApiKeyContainsWhitespace()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('api_key cannot contain whitespace');

        $client = new BasePaayesClient("sk_test_123\n");
    }

    public function testCtorThrowsIfApiKeyIsUnexpectedType()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('api_key must be null or a string');

        $client = new BasePaayesClient(['api_key' => 234]);
    }

    public function testCtorThrowsIfConfigArrayContainsUnexpectedKey()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Found unknown key(s) in configuration array: \'foo\', \'foo2\'');

        $client = new BasePaayesClient(['foo' => 'bar', 'foo2' => 'bar2']);
    }

    public function testRequestWithClientApiKey()
    {
        $client = new BasePaayesClient(['api_key' => 'sk_test_client', 'api_base' => MOCK_URL]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('sk_test_client', $this->optsReflector->getValue($charge)->apiKey);
    }

    public function testRequestWithOptsApiKey()
    {
        $client = new BasePaayesClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], ['api_key' => 'sk_test_opts']);
        static::assertNotNull($charge);
        static::assertSame('sk_test_opts', $this->optsReflector->getValue($charge)->apiKey);
    }

    public function testRequestThrowsIfNoApiKeyInClientAndOpts()
    {
        $this->expectException(\Paayes\Exception\AuthenticationException::class);
        $this->expectExceptionMessage('No API key provided.');

        $client = new BasePaayesClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('ch_123', $charge->id);
    }

    public function testRequestThrowsIfOptsIsString()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('#Do not pass a string for request options.#');

        $client = new BasePaayesClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], 'foo');
        static::assertNotNull($charge);
        static::assertSame('ch_123', $charge->id);
    }

    public function testRequestThrowsIfOptsIsArrayWithUnexpectedKeys()
    {
        $this->expectException(\Paayes\Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('Got unexpected keys in options array: foo');

        $client = new BasePaayesClient(['api_base' => MOCK_URL]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], ['foo' => 'bar']);
        static::assertNotNull($charge);
        static::assertSame('ch_123', $charge->id);
    }

    public function testRequestWithClientPaayesVersion()
    {
        $client = new BasePaayesClient([
            'api_key' => 'sk_test_client',
            'Paayes_version' => '2020-03-02',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('2020-03-02', $this->optsReflector->getValue($charge)->headers['Paayes-Version']);
    }

    public function testRequestWithOptsPaayesVersion()
    {
        $client = new BasePaayesClient([
            'api_key' => 'sk_test_client',
            'Paayes_version' => '2020-03-02',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], ['Paayes_version' => '2019-12-03']);
        static::assertNotNull($charge);
        static::assertSame('2019-12-03', $this->optsReflector->getValue($charge)->headers['Paayes-Version']);
    }

    public function testRequestWithClientPaayesAccount()
    {
        $client = new BasePaayesClient([
            'api_key' => 'sk_test_client',
            'Paayes_account' => 'acct_123',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], []);
        static::assertNotNull($charge);
        static::assertSame('acct_123', $this->optsReflector->getValue($charge)->headers['Paayes-Account']);
    }

    public function testRequestWithOptsPaayesAccount()
    {
        $client = new BasePaayesClient([
            'api_key' => 'sk_test_client',
            'Paayes_account' => 'acct_123',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request('get', '/api/v1/charges/ch_123', [], ['Paayes_account' => 'acct_456']);
        static::assertNotNull($charge);
        static::assertSame('acct_456', $this->optsReflector->getValue($charge)->headers['Paayes-Account']);
    }

    public function testRequestCollectionWithClientApiKey()
    {
        $client = new BasePaayesClient(['api_key' => 'sk_test_client', 'api_base' => MOCK_URL]);
        $charges = $client->requestCollection('get', '/api/v1/charges', [], []);
        static::assertNotNull($charges);
        static::assertSame('sk_test_client', $this->optsReflector->getValue($charges)->apiKey);
    }

    public function testRequestCollectionThrowsForNonList()
    {
        $this->expectException(\Paayes\Exception\UnexpectedValueException::class);
        $this->expectExceptionMessage('Expected to receive `Paayes\Collection` object from Paayes API. Instead received `Paayes\Charge`.');

        $client = new BasePaayesClient(['api_key' => 'sk_test_client', 'api_base' => MOCK_URL]);
        $client->requestCollection('get', '/api/v1/charges/ch_123', [], []);
    }

    public function testRequestWithOptsInParamsWarns()
    {
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);
        $this->expectExceptionMessage('Options found in $params: api_key, Paayes_account, api_base. Options should be '
            . 'passed in their own array after $params. (HINT: pass an empty array to $params if you do not have any.)');
        $client = new BasePaayesClient([
            'api_key' => 'sk_test_client',
            'Paayes_account' => 'acct_123',
            'api_base' => MOCK_URL,
        ]);
        $charge = $client->request(
            'get',
            '/api/v1/charges/ch_123',
            [
                'api_key' => 'sk_test_client',
                'Paayes_account' => 'acct_123',
                'api_base' => MOCK_URL,
            ],
            ['Paayes_account' => 'acct_456']
        );
        static::assertNotNull($charge);
        static::assertSame('acct_456', $this->optsReflector->getValue($charge)->headers['Paayes-Account']);
    }
}
