<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Checkout;

class SessionService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of Checkout Sessions.
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
        return $this->requestCollection('get', '/api/v1/checkout/sessions', $params, $opts);
    }

    /**
     * When retrieving a Checkout Session, there is an includable
     * <strong>line_items</strong> property containing the first handful of those
     * items. There is also a URL where you can retrieve the full (paginated) list of
     * line items.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Collection
     */
    public function allLineItems($parentId, $params = null, $opts = null)
    {
        return $this->requestCollection('get', $this->buildPath('/api/v1/checkout/sessions/%s/line_items', $parentId), $params, $opts);
    }

    /**
     * Creates a Session object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Checkout\Session
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/checkout/sessions', $params, $opts);
    }

    /**
     * Retrieves a Session object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Checkout\Session
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/checkout/sessions/%s', $id), $params, $opts);
    }
}
