<?php

namespace Paayes\ApiOperations;

/**
 * Trait for updatable resources. Adds an `update()` static method and a
 * `save()` method to the class.
 *
 * This trait should only be applied to classes that derive from PaayesObject.
 */
trait Update
{
    /**
     * @param string $id the ID of the resource to update
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return static the updated resource
     */
    public static function update($id, $params = null, $opts = null)
    {
        self::_validateParams($params);
        $url = static::resourceUrl($id);

        list($response, $opts) = static::_staticRequest('PUT', $url, $params, $opts);
        $obj = \Paayes\Util\Util::convertToPaayesObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }

    /**
     * @param null|array|string $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return static the saved resource
     */
    public function save($opts = null)
    {
        $params = $this->serializeParameters();
        if (\count($params) > 0) {
            $url = $this->instanceUrl();
            list($response, $opts) = $this->_request('PUT', $url, $params, $opts);
            $this->refreshFrom($response, $opts);
        }

        return $this;
    }
}
