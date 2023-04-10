<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Identity;

class VerificationReportService extends \Paayes\Service\AbstractService
{
    /**
     * List all verification reports.
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
        return $this->requestCollection('get', '/api/v1/identity/verification_reports', $params, $opts);
    }

    /**
     * Retrieves an existing VerificationReport.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Identity\VerificationReport
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/identity/verification_reports/%s', $id), $params, $opts);
    }
}
