<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class TaxCodeService extends \Paayes\Service\AbstractService
{
    /**
     * A list of <a href="https://docs.paayes.com/docs/tax/tax-codes">all tax codes
     * available</a> to add to Products in order to allow specific tax calculations.
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
        return $this->requestCollection('get', '/api/v1/tax_codes', $params, $opts);
    }

    /**
     * Retrieves the details of an existing tax code. Supply the unique tax code ID and
     * Paayes will return the corresponding tax code information.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxCode
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/tax_codes/%s', $id), $params, $opts);
    }
}
