<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class ApplePayDomainService extends \Paayes\Service\AbstractService
{
    /**
     * List apple pay domains.
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
        return $this->requestCollection('get', '/api/v1/apple_pay/domains', $params, $opts);
    }

    /**
     * Create an apple pay domain.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\ApplePayDomain
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/apple_pay/domains', $params, $opts);
    }

    /**
     * Delete an apple pay domain.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\ApplePayDomain
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/apple_pay/domains/%s', $id), $params, $opts);
    }

    /**
     * Retrieve an apple pay domain.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\ApplePayDomain
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/apple_pay/domains/%s', $id), $params, $opts);
    }
}
