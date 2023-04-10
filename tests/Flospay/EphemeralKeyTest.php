<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\EphemeralKey
 */
final class EphemeralKeyTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/api/v1/ephemeral_keys',
            null,
            ['Paayes-Version: 2017-05-25']
        );
        $resource = EphemeralKey::create([
            'customer' => 'cus_123',
        ], ['Paayes_version' => '2017-05-25']);
        static::assertInstanceOf(\Paayes\EphemeralKey::class, $resource);
    }

    public function testIsNotCreatableWithoutAnExplicitApiVersion()
    {
        $this->expectException(\InvalidArgumentException::class);

        $resource = EphemeralKey::create([
            'customer' => 'cus_123',
        ]);
    }

    public function testIsDeletable()
    {
        $key = EphemeralKey::create([
            'customer' => 'cus_123',
        ], ['Paayes_version' => '2017-05-25']);
        $this->expectsRequest(
            'delete',
            '/api/v1/ephemeral_keys/' . $key->id
        );
        $resource = $key->delete();
        static::assertInstanceOf(\Paayes\EphemeralKey::class, $resource);
    }
}
