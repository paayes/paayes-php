<?php

// File generated from our OpenAPI spec

namespace Paayes;

/**
 * Client used to send requests to Paayes's API.
 *
 * @property \Paayes\Service\AccountLinkService $accountLinks
 * @property \Paayes\Service\AccountService $accounts
 * @property \Paayes\Service\ApplePayDomainService $applePayDomains
 * @property \Paayes\Service\ApplicationFeeService $applicationFees
 * @property \Paayes\Service\BalanceService $balance
 * @property \Paayes\Service\BalanceTransactionService $balanceTransactions
 * @property \Paayes\Service\BillingPortal\BillingPortalServiceFactory $billingPortal
 * @property \Paayes\Service\ChargeService $charges
 * @property \Paayes\Service\Checkout\CheckoutServiceFactory $checkout
 * @property \Paayes\Service\CountrySpecService $countrySpecs
 * @property \Paayes\Service\CouponService $coupons
 * @property \Paayes\Service\CreditNoteService $creditNotes
 * @property \Paayes\Service\CustomerService $customers
 * @property \Paayes\Service\DisputeService $disputes
 * @property \Paayes\Service\EphemeralKeyService $ephemeralKeys
 * @property \Paayes\Service\EventService $events
 * @property \Paayes\Service\ExchangeRateService $exchangeRates
 * @property \Paayes\Service\FileLinkService $fileLinks
 * @property \Paayes\Service\FileService $files
 * @property \Paayes\Service\Identity\IdentityServiceFactory $identity
 * @property \Paayes\Service\InvoiceItemService $invoiceItems
 * @property \Paayes\Service\InvoiceService $invoices
 * @property \Paayes\Service\Issuing\IssuingServiceFactory $issuing
 * @property \Paayes\Service\MandateService $mandates
 * @property \Paayes\Service\OAuthService $oauth
 * @property \Paayes\Service\OrderReturnService $orderReturns
 * @property \Paayes\Service\OrderService $orders
 * @property \Paayes\Service\PaymentIntentService $paymentIntents
 * @property \Paayes\Service\PaymentMethodService $paymentMethods
 * @property \Paayes\Service\PayoutService $payouts
 * @property \Paayes\Service\PlanService $plans
 * @property \Paayes\Service\PriceService $prices
 * @property \Paayes\Service\ProductService $products
 * @property \Paayes\Service\PromotionCodeService $promotionCodes
 * @property \Paayes\Service\QuoteService $quotes
 * @property \Paayes\Service\Radar\RadarServiceFactory $radar
 * @property \Paayes\Service\RefundService $refunds
 * @property \Paayes\Service\Reporting\ReportingServiceFactory $reporting
 * @property \Paayes\Service\ReviewService $reviews
 * @property \Paayes\Service\SetupAttemptService $setupAttempts
 * @property \Paayes\Service\SetupIntentService $setupIntents
 * @property \Paayes\Service\Sigma\SigmaServiceFactory $sigma
 * @property \Paayes\Service\SkuService $skus
 * @property \Paayes\Service\SourceService $sources
 * @property \Paayes\Service\SubscriptionItemService $subscriptionItems
 * @property \Paayes\Service\SubscriptionScheduleService $subscriptionSchedules
 * @property \Paayes\Service\SubscriptionService $subscriptions
 * @property \Paayes\Service\TaxCodeService $taxCodes
 * @property \Paayes\Service\TaxRateService $taxRates
 * @property \Paayes\Service\Terminal\TerminalServiceFactory $terminal
 * @property \Paayes\Service\TokenService $tokens
 * @property \Paayes\Service\TopupService $topups
 * @property \Paayes\Service\TransferService $transfers
 * @property \Paayes\Service\WebhookEndpointService $webhookEndpoints
 */
class PaayesClient extends BasePaayesClient
{
    /**
     * @var \Paayes\Service\CoreServiceFactory
     */
    private $coreServiceFactory;

    public function __get($name)
    {
        if (null === $this->coreServiceFactory) {
            $this->coreServiceFactory = new \Paayes\Service\CoreServiceFactory($this);
        }

        return $this->coreServiceFactory->__get($name);
    }
}
