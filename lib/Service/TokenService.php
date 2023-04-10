<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class TokenService extends \Paayes\Service\AbstractService
{
    /**
     * Creates a single-use token that represents a bank account’s details. This token
     * can be used with any API method in place of a bank account dictionary. This
     * token can be used only once, by attaching it to a <a href="#accounts">Custom
     * account</a>.
     *
     * @param null|array $params
     * @param null|array|\Paayes\til\RequestOptions $opts
     *
     * @throws \Paayes\xception\ApiErrorException if the request fails
     *
     * @return \Paayes\oken
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/tokens', $params, $opts);
    }

    /**
     * Retrieves the token with the given ID.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\til\RequestOptions $opts
     *
     * @throws \Paayes\xception\ApiErrorException if the request fails
     *
     * @return \Paayes\oken
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/tokens/%s', $id), $params, $opts);
    }
}
