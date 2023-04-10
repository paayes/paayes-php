<?php

namespace Paayes;

/**
 * Interface for a Paayes client.
 */
interface PaayesStreamingClientInterface extends BasePaayesClientInterface
{
    public function requestStream($method, $path, $readBodyChunkCallable, $params, $opts);
}
