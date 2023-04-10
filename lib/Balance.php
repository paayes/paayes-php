<?php

// File generated from our OpenAPI spec

namespace Paayes;

/**
 * This is an object representing your Paayes balance. You can retrieve it to see
 * the balance currently on your Paayes account.
 *
 * You can also retrieve the balance history, which contains a list of <a
 * href="https://docs.paayes.com/docs/reporting/balance-transaction-types">transactions</a>
 * that contributed to the balance (charges, payouts, and so forth).
 *
 * The available and pending amounts for each currency are broken down further by
 * payment source types.
 *
 * Related guide: <a
 * href="https://docs.paayes.com/docs/connect/account-balances">Understanding Connect
 * Account Balances</a>.
 *
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Paayes\PaayesObject[] $available Funds that are available to be transferred or paid out, whether automatically by Paayes or explicitly via the <a href="https://docs.paayes.com/docs/api#transfers">Transfers API</a> or <a href="https://docs.paayes.com/docs/api#payouts">Payouts API</a>. The available balance for each currency and payment type can be found in the <code>source_types</code> property.
 * @property \Paayes\PaayesObject[] $connect_reserved Funds held due to negative balances on connected Custom accounts. The connect reserve balance for each currency and payment type can be found in the <code>source_types</code> property.
 * @property \Paayes\PaayesObject[] $instant_available Funds that can be paid out using Instant Payouts.
 * @property \Paayes\PaayesObject $issuing
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property \Paayes\PaayesObject[] $pending Funds that are not yet available in the balance, due to the 7-day rolling pay cycle. The pending balance for each currency, and for each payment type, can be found in the <code>source_types</code> property.
 */
class Balance extends SingletonApiResource
{
    const OBJECT_NAME = 'balance';

    /**
     * @param null|array|string $opts
     *
     * @throws \Paayes\Exception\ApiErrorException if the request fails
     *
     * @return \Paayes\Balance
     */
    public static function retrieve($opts = null)
    {
        return self::_singletonRetrieve($opts);
    }
}
