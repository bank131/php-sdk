<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\PayoutRefundCollection;
use Bank131\SDK\DTO\CustomerInteraction\CustomerInteractionContainer;
use DateTimeImmutable;

class Payout
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var DateTimeImmutable
     */
    private $created_at;

    /**
     * @var DateTimeImmutable|null
     */
    private $finished_at;

    /**
     * @var Customer|null
     */
    private $customer;

    /**
     * @var PaymentDetails
     */
    private $payment_method;

    /**
     * @var Amount
     */
    private $amount_details;

    /**
     * @var FiscalizationDetails
     */
    private $fiscalization_details;

    /**
     * @var CustomerInteractionContainer
     */
    private $customer_interaction;

    /**
     * @var mixed
     */
    private $metadata;

    /**
     * @var Error|null
     */
    private $error;

    /**
     * @var PayoutRefundCollection
     */
    private $refunds;

    /**
     * @var ParticipantDetails
     */
    protected $participant_details;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getFinishedAt(): ?DateTimeImmutable
    {
        return $this->finished_at;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @return PaymentDetails
     */
    public function getPaymentMethod(): PaymentDetails
    {
        return $this->payment_method;
    }

    /**
     * @return Amount
     */
    public function getAmountDetails(): Amount
    {
        return $this->amount_details;
    }

    /**
     * @return FiscalizationDetails
     */
    public function getFiscalizationDetails(): FiscalizationDetails
    {
        return $this->fiscalization_details;
    }

    /**
     * @return CustomerInteractionContainer
     */
    public function getCustomerInteraction(): CustomerInteractionContainer
    {
        return $this->customer_interaction;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return Error|null
     */
    public function getError(): ?Error
    {
        return $this->error;
    }

    /**
     * @return ParticipantDetails
     */
    public function getParticipantDetails(): ParticipantDetails
    {
        return $this->participant_details;
    }

    public function getRefunds(): PayoutRefundCollection
    {
        return $this->refunds;
    }

    public function setRefunds(PayoutRefundCollection $refunds): void
    {
        $this->refunds = $refunds;
    }
}
