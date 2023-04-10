<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Issuing;

class TransactionService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of Issuing <code>Transaction</code> objects. The objects are
     * sorted in descending order by creation date, with the most recently created
     * object appearing first.
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
        return $this->requestCollection('get', '/api/v1/issuing/transactions', $params, $opts);
    }

    /**
     * Retrieves an Issuing <code>Transaction</code> object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Issuing\Transaction
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/issuing/transactions/%s', $id), $params, $opts);
    }

    /**
     * Updates the specified Issuing <code>Transaction</code> object by setting the
     * values of the parameters passed. Any parameters not provided will be left
     * unchanged.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Issuing\Transaction
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/issuing/transactions/%s', $id), $params, $opts);
    }
}
