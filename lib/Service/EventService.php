<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class EventService extends \Paayes\Service\AbstractService
{
    /**
     * List events, going back up to 30 days. Each event data is rendered according to
     * Paayes API version at its creation time, specified in <a
     * href="/docs/api/events/object">event object</a> <code>api_version</code>
     * attribute (not according to your current Paayes API version or
     * <code>Paayes-Version</code> header).
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
        return $this->requestCollection('get', '/api/v1/events', $params, $opts);
    }

    /**
     * Retrieves the details of an event. Supply the unique identifier of the event,
     * which you might have received in a webhook.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Event
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/events/%s', $id), $params, $opts);
    }
}
