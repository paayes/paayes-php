<?php

namespace Paayes\Exception\OAuth;

/**
 * Implements properties and methods common to all (non-SPL) Paayes OAuth
 * exceptions.
 */
abstract class OAuthErrorException extends \Paayes\Exception\ApiErrorException
{
    protected function constructErrorObject()
    {
        if (null === $this->jsonBody) {
            return null;
        }

        return \Paayes\OAuthErrorObject::constructFrom($this->jsonBody);
    }
}
