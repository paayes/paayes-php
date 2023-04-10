<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Terminal;

/**
 * Service factory class for API resources in the Terminal namespace.
 *
 * @property ConnectionTokenService $connectionTokens
 * @property LocationService $locations
 * @property ReaderService $readers
 */
class TerminalServiceFactory extends \Paayes\Service\AbstractServiceFactory
{
    /**
     * @var array<string, string>
     */
    private static $classMap = [
        'connectionTokens' => ConnectionTokenService::class,
        'locations' => LocationService::class,
        'readers' => ReaderService::class,
    ];

    protected function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
