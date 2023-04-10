<?php

namespace Paayes\ApiOperations;

/**
 * Trait for creatable resources. Adds a `create()` static method to the class.
 *
 * This trait should only be applied to classes that derive from PaayesObject.
 */
trait Create
{
    /**
     * @param null|array $params
     * @param null|array|string $options
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return static the created resource
     */
    public static function create($params = null, $options = null)
    {
        self::_validateParams($params);
        $url = static::classUrl();

        list($response, $opts) = static::_staticRequest('post', $url, $params, $options);
        $obj = \Paayes\Util\Util::convertToPaayesObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }
}
