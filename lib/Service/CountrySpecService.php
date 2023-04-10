<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class CountrySpecService extends \Paayes\Service\AbstractService
{
    /**
     * Lists all Country Spec objects available in the API.
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
        return $this->requestCollection('get', '/api/v1/country_specs', $params, $opts);
    }

    /**
     * Returns a Country Spec for a given Country code.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\CountrySpec
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/country_specs/%s', $id), $params, $opts);
    }
}
