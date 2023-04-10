<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class OrderReturnService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of your order returns. The returns are returned sorted by
     * creation date, with the most recently created return appearing first.
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
        return $this->requestCollection('get', '/api/v1/order_returns', $params, $opts);
    }

    /**
     * Retrieves the details of an existing order return. Supply the unique order ID
     * from either an order return creation request or the order return list, and
     * Paayes will return the corresponding order information.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\OrderReturn
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/order_returns/%s', $id), $params, $opts);
    }
}
