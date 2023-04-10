<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class ProductService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of your products. The products are returned sorted by creation
     * date, with the most recently created products appearing first.
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
        return $this->requestCollection('get', '/api/v1/products', $params, $opts);
    }

    /**
     * Creates a new product object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Product
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/products', $params, $opts);
    }

    /**
     * Delete a product. Deleting a product is only possible if it has no prices
     * associated with it. Additionally, deleting a product with <code>type=good</code>
     * is only possible if it has no SKUs associated with it.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Product
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/products/%s', $id), $params, $opts);
    }

    /**
     * Retrieves the details of an existing product. Supply the unique product ID from
     * either a product creation request or the product list, and Paayes will return
     * the corresponding product information.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Product
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/products/%s', $id), $params, $opts);
    }

    /**
     * Updates the specific product by setting the values of the parameters passed. Any
     * parameters not provided will be left unchanged.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Product
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/products/%s', $id), $params, $opts);
    }
}
