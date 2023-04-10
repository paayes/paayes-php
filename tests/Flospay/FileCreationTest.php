<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\File
 */
final class FileCreationTest extends \PHPUnit\Framework\TestCase
{
    // These tests should really be part of `FileTest`, but because the file creation requests use a
    // different host, the tests for these methods need their own setup and teardown methods.

    use TestHelper;

    /** @var null|string */
    private $origApiUploadBase;

    /** @before */
    public function setUpUploadBase()
    {
        $this->origApiBase = Paayes::$apiBase;
        $this->origApiUploadBase = Paayes::$apiUploadBase;

        Paayes::$apiUploadBase = \defined('MOCK_URL') ? MOCK_URL : 'http://localhost:12111';
        Paayes::$apiBase = null;
    }

    /** @after */
    public function tearDownUploadBase()
    {
        Paayes::$apiBase = $this->origApiBase;
        Paayes::$apiUploadBase = $this->origApiUploadBase;
    }

    public function testIsCreatableWithFileHandle()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            Paayes::$apiUploadBase
        );
        $fp = \fopen(__DIR__ . '/../data/test.png', 'rb');
        $resource = File::create([
            'purpose' => 'dispute_evidence',
            'file' => $fp,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Paayes\File::class, $resource);
    }

    public function testIsCreatableWithCURLFile()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/files',
            null,
            ['Content-Type: multipart/form-data'],
            true,
            Paayes::$apiUploadBase
        );
        $curlFile = new \CURLFile(__DIR__ . '/../data/test.png');
        $resource = File::create([
            'purpose' => 'dispute_evidence',
            'file' => $curlFile,
            'file_link_data' => ['create' => true],
        ]);
        static::assertInstanceOf(\Paayes\File::class, $resource);
    }
}
