<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Reporting;

class ReportRunService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of Report Runs, with the most recent appearing first.
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
        return $this->requestCollection('get', '/api/v1/reporting/report_runs', $params, $opts);
    }

    /**
     * Creates a new object and begin running the report. (Certain report types require
     * a <a href="https://docs.paayes.com/docs/keys#test-live-modes">live-mode API key</a>.).
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Reporting\ReportRun
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/reporting/report_runs', $params, $opts);
    }

    /**
     * Retrieves the details of an existing Report Run.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Reporting\ReportRun
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/reporting/report_runs/%s', $id), $params, $opts);
    }
}
