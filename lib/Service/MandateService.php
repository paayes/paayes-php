<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class MandateService extends \Paayes\Service\AbstractService
{
    /**
     * Retrieves a Mandate object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Mandate
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/mandates/%s', $id), $params, $opts);
    }
}
