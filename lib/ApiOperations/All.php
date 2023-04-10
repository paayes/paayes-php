<?php

namespace Paayes\ApiOperations;

/**
 * Trait for listable resources. Adds a `all()` static method to the class.
 *
 * This trait should only be applied to classes that derive from PaayesObject.
 */
trait All
{
    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Collection of ApiResources
     */
    public static function all($params = null, $opts = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \Paayes\Util\Util::convertToPaayesObject($response->json, $opts);
        if (!($obj instanceof \Paayes\Collection)) {
            throw new \Paayes\Exception\UnexpectedValueException(
                'Expected type ' . \Paayes\Collection::class . ', got "' . \get_class($obj) . '" instead.'
            );
        }
        $obj->setLastResponse($response);
        $obj->setFilters($params);

        return $obj;
    }
}
