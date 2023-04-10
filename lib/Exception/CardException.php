<?php

namespace Paayes\Exception;

/**
 * CardException is thrown when a user enters a card that can't be charged for
 * some reason.
 */
class CardException extends ApiErrorException
{
    protected $declineCode;
    protected $PaayesParam;

    /**
     * Creates a new CardException exception.
     *
     * @param string $message the exception message
     * @param null|int $httpStatus the HTTP status code
     * @param null|string $httpBody the HTTP body as a string
     * @param null|array $jsonBody the JSON deserialized body
     * @param null|array|\Paayes\Util\CaseInsensitiveArray $httpHeaders the HTTP headers array
     * @param null|string $PaayesCode the Paayes error code
     * @param null|string $declineCode the decline code
     * @param null|string $PaayesParam the parameter related to the error
     *
     * @return CardException
     */
    public static function factory(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null,
        $PaayesCode = null,
        $declineCode = null,
        $PaayesParam = null
    ) {
        $instance = parent::factory($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders, $PaayesCode);
        $instance->setDeclineCode($declineCode);
        $instance->setPaayesParam($PaayesParam);

        return $instance;
    }

    /**
     * Gets the decline code.
     *
     * @return null|string
     */
    public function getDeclineCode()
    {
        return $this->declineCode;
    }

    /**
     * Sets the decline code.
     *
     * @param null|string $declineCode
     */
    public function setDeclineCode($declineCode)
    {
        $this->declineCode = $declineCode;
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
