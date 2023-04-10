<?php

// File generated from our OpenAPI spec

namespace Paayes\Service;

class CustomerService extends \Paayes\Service\AbstractService
{
    /**
     * Returns a list of your customers. The customers are returned sorted by creation
     * date, with the most recent customers appearing first.
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
        return $this->requestCollection('get', '/api/v1/customers', $params, $opts);
    }

    /**
     * Returns a list of transactions that updated the customer’s <a
     * href="/docs/billing/customer/balance">balances</a>.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Collection
     */
    public function allBalanceTransactions($parentId, $params = null, $opts = null)
    {
        return $this->requestCollection('get', $this->buildPath('/api/v1/customers/%s/balance_transactions', $parentId), $params, $opts);
    }

    /**
     * List sources for a specified customer.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Collection
     */
    public function allSources($parentId, $params = null, $opts = null)
    {
        return $this->requestCollection('get', $this->buildPath('/api/v1/customers/%s/sources', $parentId), $params, $opts);
    }

    /**
     * Returns a list of tax IDs for a customer.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Collection
     */
    public function allTaxIds($parentId, $params = null, $opts = null)
    {
        return $this->requestCollection('get', $this->buildPath('/api/v1/customers/%s/tax_ids', $parentId), $params, $opts);
    }

    /**
     * Creates a new customer object.
     *
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Customer
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/api/v1/customers', $params, $opts);
    }

    /**
     * Creates an immutable transaction that updates the customer’s credit <a
     * href="/docs/billing/customer/balance">balance</a>.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\CustomerBalanceTransaction
     */
    public function createBalanceTransaction($parentId, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/customers/%s/balance_transactions', $parentId), $params, $opts);
    }

    /**
     * When you create a new credit card, you must specify a customer or recipient on
     * which to create it.
     *
     * If the card’s owner has no default card, then the new card will become the
     * default. However, if the owner already has a default, then it will not change.
     * To change the default, you should <a href="/docs/api#update_customer">update the
     * customer</a> to have a new <code>default_source</code>.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\AlipayAccount|\Paayes\BankAccount|\Paayes\BitcoinReceiver|\Paayes\Card|\Paayes\Source
     */
    public function createSource($parentId, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/customers/%s/sources', $parentId), $params, $opts);
    }

    /**
     * Creates a new <code>TaxID</code> object for a customer.
     *
     * @param string $parentId
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxId
     */
    public function createTaxId($parentId, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/customers/%s/tax_ids', $parentId), $params, $opts);
    }

    /**
     * Permanently deletes a customer. It cannot be undone. Also immediately cancels
     * any active subscriptions on the customer.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Customer
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/customers/%s', $id), $params, $opts);
    }

    /**
     * Removes the currently applied discount on a customer.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Customer
     */
    public function deleteDiscount($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/customers/%s/discount', $id), $params, $opts);
    }

    /**
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\AlipayAccount|\Paayes\BankAccount|\Paayes\BitcoinReceiver|\Paayes\Card|\Paayes\Source
     */
    public function deleteSource($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/customers/%s/sources/%s', $parentId, $id), $params, $opts);
    }

    /**
     * Deletes an existing <code>TaxID</code> object.
     *
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxId
     */
    public function deleteTaxId($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/api/v1/customers/%s/tax_ids/%s', $parentId, $id), $params, $opts);
    }

    /**
     * Retrieves the details of an existing customer. You need only supply the unique
     * customer identifier that was returned upon customer creation.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Customer
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/customers/%s', $id), $params, $opts);
    }

    /**
     * Retrieves a specific customer balance transaction that updated the customer’s <a
     * href="/docs/billing/customer/balance">balances</a>.
     *
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\CustomerBalanceTransaction
     */
    public function retrieveBalanceTransaction($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/customers/%s/balance_transactions/%s', $parentId, $id), $params, $opts);
    }

    /**
     * Retrieve a specified source for a given customer.
     *
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\AlipayAccount|\Paayes\BankAccount|\Paayes\BitcoinReceiver|\Paayes\Card|\Paayes\Source
     */
    public function retrieveSource($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/customers/%s/sources/%s', $parentId, $id), $params, $opts);
    }

    /**
     * Retrieves the <code>TaxID</code> object with the given identifier.
     *
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\TaxId
     */
    public function retrieveTaxId($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/api/v1/customers/%s/tax_ids/%s', $parentId, $id), $params, $opts);
    }

    /**
     * Updates the specified customer by setting the values of the parameters passed.
     * Any parameters not provided will be left unchanged. For example, if you pass the
     * <strong>source</strong> parameter, that becomes the customer’s active source
     * (e.g., a card) to be used for all charges in the future. When you update a
     * customer to a new valid card source by passing the <strong>source</strong>
     * parameter: for each of the customer’s current subscriptions, if the subscription
     * bills automatically and is in the <code>past_due</code> state, then the latest
     * open invoice for the subscription with automatic collection enabled will be
     * retried. This retry will not count as an automatic retry, and will not affect
     * the next regularly scheduled payment for the invoice. Changing the
     * <strong>default_source</strong> for a customer will not trigger this behavior.
     *
     * This request accepts mostly the same arguments as the customer creation call.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Customer
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('put', $this->buildPath('/api/v1/customers/%s', $id), $params, $opts);
    }

    /**
     * Most credit balance transaction fields are immutable, but you may update its
     * <code>description</code> and <code>metadata</code>.
     *
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\CustomerBalanceTransaction
     */
    public function updateBalanceTransaction($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('put', $this->buildPath('/api/v1/customers/%s/balance_transactions/%s', $parentId, $id), $params, $opts);
    }

    /**
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\AlipayAccount|\Paayes\BankAccount|\Paayes\BitcoinReceiver|\Paayes\Card|\Paayes\Source
     */
    public function updateSource($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('put', $this->buildPath('/api/v1/customers/%s/sources/%s', $parentId, $id), $params, $opts);
    }

    /**
     * @param string $parentId
     * @param string $id
     * @param null|array $params
     * @param null|array|\Paayes\Util\RequestOptions $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\AlipayAccount|\Paayes\BankAccount|\Paayes\BitcoinReceiver|\Paayes\Card|\Paayes\Source
     */
    public function verifySource($parentId, $id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/api/v1/customers/%s/sources/%s/verify', $parentId, $id), $params, $opts);
    }
}
