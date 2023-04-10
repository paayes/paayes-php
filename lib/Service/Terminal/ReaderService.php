<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Terminal;

class ReaderService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of <code>Reader</code> objects.
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
        return $this->requestCollection('get', '/api/v1/terminal/readers', $params, $opts);
    }

    /**
     * Creates a new <code>Reader</code> object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Terminal\Reader
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/terminal/readers', $params, $opts);
    }

    /**
     * Deletes a <code>Reader</code> object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Terminal\Reader
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/terminal/readers/%s', $id), $params, $opts);
    }

    /**
     * Retrieves a <code>Reader</code> object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Terminal\Reader
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/terminal/readers/%s', $id), $params, $opts);
    }

    /**
     * Updates a <code>Reader</code> object by setting the values of the parameters
     * passed. Any parameters not provided will be left unchanged.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Terminal\Reader
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/terminal/readers/%s', $id), $params, $opts);
    }
}
