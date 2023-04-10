<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\File
 */
final class FileTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    const TEST_RESOURCE_ID = 'file_123';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/files'
        );
        $resources = File::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Paayes\File::class, $resources->data[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/api/v1/files/' . self::TEST_RESOURCE_ID
        );
        $resource = File::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Paayes\File::class, $resource);
    }

    public function testDeserializesFromFile()
    {
        $obj = Util\Util::convertToPaayesObject([
            'object' => 'file',
        ], null);
        static::assertInstanceOf(\Paayes\File::class, $obj);
    }

    public function testDeserializesFromFileUpload()
    {
        $obj = Util\Util::convertToPaayesObject([
            'object' => 'file_upload',
        ], null);
        static::assertInstanceOf(\Paayes\File::class, $obj);
    }
}
