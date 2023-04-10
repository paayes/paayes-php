<?php

namespace Paayes;

/**
 * Interface for a Paayes client.
 */
interface BasePaayesClientInterface
{
    /**
     * Gets the API key used by the client to send requests.
     *
     * @return null|string the API key used by the client to send requests
     */
    public function getApiKey();

    /**
     * Gets the client ID used by the client in OAuth requests.
     *
     * @return null|string the client ID used by the client in OAuth requests
     */
    public function getClientId();

    /**
     * Gets the base URL for Paayes's API.
     *
     * @return string the base URL for Paayes's API
     */
    public function getApiBase();

    /**
     * Gets the base URL for Paayes's OAuth API.
     *
     * @return string the base URL for Paayes's OAuth API
     */
    public function getConnectBase();

    /**
     * Gets the base URL for Paayes's Files API.
     *
     * @return string the base URL for Paayes's Files API
     */
    public function getFilesBase();
}
