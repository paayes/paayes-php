<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Terminal;

class ConnectionTokenService extends \Paayes\Service\AbstractService
{
    /**
     * To connect to a reader the Paayes Terminal SDK needs to retrieve a short-lived
     * connection token from Paayes, proxied through your server. On your backend, add
     * an endpoint that creates and returns a connection token.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Terminal\ConnectionToken
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/terminal/connection_tokens', $params, $opts);
    }
}
