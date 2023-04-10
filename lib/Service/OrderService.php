<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class OrderService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of your orders. The orders are returned sorted by creation date,
     * with the most recently created orders appearing first.
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
        return $this->requestCollection('get', '/api/v1/orders', $params, $opts);
    }

    /**
     * Creates a new order object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Order
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/orders', $params, $opts);
    }

    /**
     * Pay an order by providing a <code>source</code> to create a payment.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Order
     */
    public function pay($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/orders/%s/pay', $id), $params, $opts);
    }

    /**
     * Retrieves the details of an existing order. Supply the unique order ID from
     * either an order creation request or the order list, and Paayes will return the
     * corresponding order information.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Order
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/orders/%s', $id), $params, $opts);
    }

    /**
     * Return all or part of an order. The order must have a status of
     * <code>paid</code> or <code>fulfilled</code> before it can be returned. Once all
     * items have been returned, the order will become <code>canceled</code> or
     * <code>returned</code> depending on which status the order started in.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Order
     */
    public function returnOrder($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/orders/%s/returns', $id), $params, $opts);
    }

    /**
     * Updates the specific order by setting the values of the parameters passed. Any
     * parameters not provided will be left unchanged.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Order
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/orders/%s', $id), $params, $opts);
    }
}
