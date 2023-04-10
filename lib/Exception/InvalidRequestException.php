<?php

namespace Paayes\Exception;

/**
 * InvalidRequestException is thrown when a request is initiated with invalid
 * parameters.
 */
class InvalidRequestException extends ApiErrorException
{
    protected $PaayesParam;

    /**
     * Creates a new InvalidRequestException exception.
     *
     * @param string $message the exception message
     * @param null|int $httpStatus the HTTP status code
     * @param null|string $httpBody the HTTP body as a string
     * @param null|array $jsonBody the JSON deserialized body
     * @param null|array|\Paayes\Util\CaseInsensitiveArray $httpHeaders the HTTP headers array
     * @param null|string $PaayesCode the Paayes error code
     * @param null|string $PaayesParam the parameter related to the error
     *
     * @return InvalidRequestException
     */
    public static function factory(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null,
        $PaayesCode = null,
        $PaayesParam = null
    ) {
        $instance = parent::factory($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders, $PaayesCode);
        $instance->setPaayesParam($PaayesParam);

        return $instance;
    }

    /**
     * Gets the parameter related to the error.
     *
     * @return null|string
     */
    public function getPaayesParam()
    {
        return $this->PaayesParam;
    }

    /**
     * Sets the parameter related to the error.
     *
     * @param null|string $PaayesParam
     */
    public function setPaayesParam($PaayesParam)
    {
        $this->PaayesParam = $PaayesParam;
    }
}
