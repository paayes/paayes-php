<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class AccountLinkService extends \Paayes\Service\AbstractService
{
    /**
     * Creates an AccountLink object that includes a single-use Paayes URL that the
     * platform can redirect their user to in order to take them through the Connect
     * Onboarding flow.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\AccountLink
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/account_links', $params, $opts);
    }
}
