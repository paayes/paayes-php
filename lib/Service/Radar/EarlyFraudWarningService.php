<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Radar;

class EarlyFraudWarningService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of early fraud warnings.
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
        return $this->requestCollection('get', '/api/v1/radar/early_fraud_warnings', $params, $opts);
    }

    /**
     * Retrieves the details of an early fraud warning that has previously been
     * created.
     *
     * Please refer to the <a href="#early_fraud_warning_object">early fraud
     * warning</a> object reference for more details.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Radar\EarlyFraudWarning
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/radar/early_fraud_warnings/%s', $id), $params, $opts);
    }
}
