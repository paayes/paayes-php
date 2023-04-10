<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class FileLinkService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of file links.
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
        return $this->requestCollection('get', '/api/v1/file_links', $params, $opts);
    }

    /**
     * Creates a new file link object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\FileLink
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/file_links', $params, $opts);
    }

    /**
     * Retrieves the file link with the given ID.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\FileLink
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/file_links/%s', $id), $params, $opts);
    }

    /**
     * Updates an existing file link object. Expired links can no longer be updated.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\FileLink
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/file_links/%s', $id), $params, $opts);
    }
}
