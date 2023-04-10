<?php

namespace Paayes;

/**
 * @internal
 * @covers \Paayes\Paayes
 */
final class PaayesTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    /** @var array */
    protected $orig;

    /**
     * @before
     */
    public function saveOriginalValues()
    {
        $this->orig = [
            'caBundlePath' => Paayes::$caBundlePath,
        ];
    }

    /**
     * @after
     */
    public function restoreOriginalValues()
    {
        Paayes::$caBundlePath = $this->orig['caBundlePath'];
    }

    public function testCABundlePathAccessors()
    {
        Paayes::setCABundlePath('path/to/ca/bundle');
        static::assertSame('path/to/ca/bundle', Paayes::getCABundlePath());
    }
}
