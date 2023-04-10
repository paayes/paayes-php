<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class ExchangeRateService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of objects that contain the rates at which foreign currencies are
     * converted to one another. Only shows the currencies for which Paayes supports.
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
        return $this->requestCollection('get', '/api/v1/exchange_rates', $params, $opts);
    }

    /**
     * Retrieves the exchange rates from the given currency to every supported
     * currency.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\ExchangeRate
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/exchange_rates/%s', $id), $params, $opts);
    }
}
