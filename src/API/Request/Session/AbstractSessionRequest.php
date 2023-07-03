<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\Collection\RevenueSplitInfoCollection;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\CustomRouting;
use Bank131\SDK\DTO\FiscalizationDetails;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentOptions;

abstract class AbstractSessionRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $session_id;

    /**
     * @var Amount
     */
    private $amount_details;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var PaymentOptions
     */
    private $payment_options;

    /**
     * @var mixed
     */
    private $metadata;

    /**
     * @var PaymentDetails
     */
    private $payment_details;

    /**
     * @var PaymentDetails
     */
    private $payment_method;

    /**
     * @var ParticipantDetails
     */
    private $participant_details;

    /**
     * @var FiscalizationDetails
     */
    private $fiscalization_details;

    /**
     * @var CustomRouting
     */
    private $custom_routing;

    /**
     * @var RevenueSplitInfoCollection|null
     */
    private $revenue_split_info;

    /**
     * @param mixed $metadata
     */
    public function setMetadata($metadata): void
    {
        $this->validateScalarOrArray($metadata);
        $this->metadata = $metadata;
    }

    /**
     * @param PaymentOptions $paymentOptions
     */
    public function setPaymentOptions(PaymentOptions $paymentOptions): void
    {
        $this->payment_options = $paymentOptions;
    }

    /**
     * @param PaymentDetails $payment_details
     */
    public function setPaymentDetails(PaymentDetails $payment_details): void
    {
        $this->payment_details = $payment_details;
    }

    /**
     * @param PaymentDetails $payment_method
     */
    public function setPaymentMethod(PaymentDetails $payment_method): void
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @param Amount $amount
     */
    public function setAmount(Amount $amount): void
    {
        $this->amount_details = $amount;
    }

    /**
     * @param string $session_id
     */
    public function setSessionId(string $session_id): void
    {
        $this->session_id = $session_id;
    }

    /**
     * @param ParticipantDetails $participant_details
     */
    public function setParticipantDetails(ParticipantDetails $participant_details): void
    {
        $this->participant_details = $participant_details;
    }

    /**
     * @param FiscalizationDetails $fiscalizationDetails
     */
    public function setFiscalizationDetails(FiscalizationDetails $fiscalizationDetails): void
    {
        $this->fiscalization_details = $fiscalizationDetails;
    }

    public function setCustomRouting(CustomRouting $customRouting): void
    {
        $this->custom_routing = $customRouting;
    }

    /**
     * @experimental
     */
    public function setRevenueSplitInfo(RevenueSplitInfoCollection $revenueSplitInfo): void
    {
        $this->revenue_split_info = $revenueSplitInfo;
    }
}
