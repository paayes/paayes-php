<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class BalanceTransactionService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of transactions that have contributed to the Paayes account
     * balance (e.g., charges, transfers, and so forth). The transactions are returned
     * in sorted order, with the most recent transactions appearing first.
     *
     * Note that this endpoint was previously called “Balance history” and used the
     * path <code>/api/v1/balance/history</code>.
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
        return $this->requestCollection('get', '/api/v1/balance_transactions', $params, $opts);
    }

    /**
     * Retrieves the balance transaction with the given ID.
     *
     * Note that this endpoint previously used the path
     * <code>/api/v1/balance/history/:id</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\BalanceTransaction
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/balance_transactions/%s', $id), $params, $opts);
    }
}
