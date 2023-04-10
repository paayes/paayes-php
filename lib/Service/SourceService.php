<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class SourceService extends \Paayes\Service\AbstractService
{
    /**
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Source
     */
    public function allTransactions($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/sources/%s/source_transactions', $id), $params, $opts);
    }

    /**
     * Creates a new source object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Source
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/sources', $params, $opts);
    }

    /**
     * Delete a specified source for a given customer.
     *
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Source
     */
    public function detach($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/customers/%s/sources/%s', $parentId, $id), $params, $opts);
    }

    /**
     * Retrieves an existing source object. Supply the unique source ID from a source
     * creation request and Paayes will return the corresponding up-to-date source
     * object information.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Source
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/sources/%s', $id), $params, $opts);
    }

    /**
     * Updates the specified source by setting the values of the parameters passed. Any
     * parameters not provided will be left unchanged.
     *
     * This request accepts the <code>metadata</code> and <code>owner</code> as
     * arguments. It is also possible to update type specific information for selected
     * payment methods. Please refer to our <a href="/docs/sources">payment method
     * guides</a> for more detail.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Source
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/sources/%s', $id), $params, $opts);
    }

    /**
     * Verify a given source.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Source
     */
    public function verify($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/sources/%s/verify', $id), $params, $opts);
    }
}
