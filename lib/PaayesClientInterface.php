<?php

namespace Paayes;

/**
 * Interface for a Paayes client.
 */
interface PaayesClientInterface extends BasePaayesClientInterface
{
    /**
     * Sends a request to Paayes's API.
     *
     * @param string $method the HTTP method
     * @param string $path the path of the request
     * @param array $params the parameters of the request
     * @param array|\Paayes\Util\RequestOptions $opts the special modifiers of the request
     *
     * @return \Paayes\PaayesObject the object returned by Paayes's API
     */
    public function request($method, $path, $params, $opts);
}
