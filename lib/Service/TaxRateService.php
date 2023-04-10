<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class TaxRateService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of your tax rates. Tax rates are returned sorted by creation
     * date, with the most recently created tax rates appearing first.
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
        return $this->requestCollection('get', '/api/v1/tax_rates', $params, $opts);
    }

    /**
     * Creates a new tax rate.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxRate
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/tax_rates', $params, $opts);
    }

    /**
     * Retrieves a tax rate with the given ID.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxRate
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/tax_rates/%s', $id), $params, $opts);
    }

    /**
     * Updates an existing tax rate.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxRate
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/tax_rates/%s', $id), $params, $opts);
    }
}
