<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class PriceService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of your prices.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Collection
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/api/v1/prices', $params, $opts);
    }

    /**
     * Creates a new price for an existing product. The price can be recurring or
     * one-time.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Price
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/prices', $params, $opts);
    }

    /**
     * Retrieves the price with the given ID.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Price
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/prices/%s', $id), $params, $opts);
    }

    /**
     * Updates the specified price by setting the values of the parameters passed. Any
     * parameters not provided are left unchanged.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Price
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/prices/%s', $id), $params, $opts);
    }
}
