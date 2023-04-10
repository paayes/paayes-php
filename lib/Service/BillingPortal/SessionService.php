<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\BillingPortal;

class SessionService extends \Paayes\Service\AbstractService
{
    /**
     * Creates a session of the customer portal.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\BillingPortal\Session
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/billing_portal/sessions', $params, $opts);
    }
}
