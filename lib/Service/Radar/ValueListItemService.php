<?php

// File generated from our OpenAPI spec

namespace Paayes\Service\Radar;

class ValueListItemService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of <code>ValueListItem</code> objects. The objects are sorted in
     * descending order by creation date, with the most recently created object
     * appearing first.
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
        return $this->requestCollection('get', '/api/v1/radar/value_list_items', $params, $opts);
    }

    /**
     * Creates a new <code>ValueListItem</code> object, which is added to the specified
     * parent value list.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Radar\ValueListItem
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/radar/value_list_items', $params, $opts);
    }

    /**
     * Deletes a <code>ValueListItem</code> object, removing it from its parent value
     * list.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Radar\ValueListItem
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/radar/value_list_items/%s', $id), $params, $opts);
    }

    /**
     * Retrieves a <code>ValueListItem</code> object.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Radar\ValueListItem
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/radar/value_list_items/%s', $id), $params, $opts);
    }
}
