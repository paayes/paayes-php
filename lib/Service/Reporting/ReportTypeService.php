<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Reporting;

class ReportTypeService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a full list of Report Types.
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
        return $this->requestCollection('get', '/api/v1/reporting/report_types', $params, $opts);
    }

    /**
     * Retrieves the details of a Report Type. (Certain report types require a <a
     * href="https://docs.paayes.com/docs/keys#test-live-modes">live-mode API key</a>.).
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Reporting\ReportType
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/reporting/report_types/%s', $id), $params, $opts);
    }
}
