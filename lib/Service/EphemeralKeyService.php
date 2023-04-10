<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class EphemeralKeyService extends \Paayes\Service\AbstractService
{
    /**
     * Invalidates a short-lived API key for a given resource.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\EphemeralKey
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/ephemeral_keys/%s', $id), $params, $opts);
    }

    /**
     * Creates a short-lived API key for a given resource.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\EphemeralKey
     */
    public function create($params = null, $opts = null)
    {
        if (!$opts || !isset($opts['Paayes_version'])) {
            throw new \Paayes\Exception\InvalidArgumentException('Paayes_version must be specified to create an ephemeral key');
        }

        return $this->request('post', '/api/v1/ephemeral_keys', $params, $opts);
    }
}
