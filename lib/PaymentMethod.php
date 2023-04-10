<?php

// File generated from our OpenAPI spec

namespace Paayes;

/**
 * PaymentMethod objects represent your customer's payment instruments. They can be
 * used with <a
 * href="https://docs.paayes.com/docs/payments/payment-intents">PaymentIntents</a> to
 * collect payments or saved to Customer objects to store instrument details for
 * future payments.
 *
 * Related guides: <a
 * href="https://docs.paayes.com/docs/payments/payment-methods">Payment Methods</a> and
 * <a href="https://docs.paayes.com/docs/payments/more-payment-scenarios">More Payment
 * Scenarios</a>.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Paayes\PaayesObject $acss_debit
 * @property \Paayes\PaayesObject $afterpay_clearpay
 * @property \Paayes\PaayesObject $alipay
 * @property \Paayes\PaayesObject $au_becs_debit
 * @property \Paayes\PaayesObject $bacs_debit
 * @property \Paayes\PaayesObject $bancontact
 * @property \Paayes\PaayesObject $billing_details
 * @property \Paayes\PaayesObject $boleto
 * @property \Paayes\PaayesObject $card
 * @property \Paayes\PaayesObject $card_present
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property null|string|\Paayes\Customer $customer The ID of the Customer to which this PaymentMethod is saved. This will not be set when the PaymentMethod has not been saved to a Customer.
 * @property \Paayes\PaayesObject $eps
 * @property \Paayes\PaayesObject $fpx
 * @property \Paayes\PaayesObject $giropay
 * @property \Paayes\PaayesObject $grabpay
 * @property \Paayes\PaayesObject $ideal
 * @property \Paayes\PaayesObject $interac_present
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property null|\Paayes\PaayesObject $metadata Set of <a href="https://docs.paayes.com/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 * @property \Paayes\PaayesObject $oxxo
 * @property \Paayes\PaayesObject $p24
 * @property \Paayes\PaayesObject $sepa_debit
 * @property \Paayes\PaayesObject $sofort
 * @property string $type The type of the PaymentMethod. An additional hash is included on the PaymentMethod with a name matching this value. It contains additional information specific to the PaymentMethod type.
 * @property \Paayes\PaayesObject $wechat_pay
 */
class PaymentMethod extends ApiResource
{
    const OBJECT_NAME = 'payment_method';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\PaymentMethod the attached payment method
     */
    public function attach($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/attach';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\PaymentMethod the detached payment method
     */
    public function detach($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/detach';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }
}
