<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\AcquiringPaymentRefundCollection;
use Bank131\SDK\DTO\CustomerInteraction\CustomerInteractionContainer;
use Bank131\SDK\DTO\Enum\AcquiringPaymentStatusEnum;
use DateTimeImmutable;

class AcquiringPayment
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
    private $updated_at;

    /**
     * @var DateTimeImmutable|null
     */
    private $finished_at;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var PaymentDetails
     */
    private $payment_details;

    /**
     * @var Amount
     */
    private $amount_details;

    /**
     * @var ParticipantDetails|null
     */
    private $participant_details;

    /**
     * @var PaymentOptions|null
     */
    private $payment_options;

    /**
     * @var AcquiringPaymentRefundCollection
     */
    private $refunds;

    /**
     * @var string|null
     */
    private $recurrent_token;

    /**
     * @var CustomerInteractionContainer|null
     */
    private $customer_interaction;

    /**
     * @var string|null
     */
    private $metadata;

    /**
     * @var Error|null
     */
    private $error;

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
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getFinishedAt(): ?DateTimeImmutable
    {
        return $this->finished_at;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return PaymentDetails
     */
    public function getPaymentDetails(): PaymentDetails
    {
        return $this->payment_details;
    }

    /**
     * @return Amount
     */
    public function getAmountDetails(): Amount
    {
        return $this->amount_details;
    }

    /**
     * @return ParticipantDetails|null
     */
    public function getParticipantDetails(): ?object
    {
        return $this->participant_details;
    }

    /**
     * @return PaymentOptions|null
     */
    public function getPaymentOptions(): ?PaymentOptions
    {
        return $this->payment_options;
    }

    /**
     * @return AcquiringPaymentRefundCollection
     */
    public function getRefunds(): AcquiringPaymentRefundCollection
    {
        return $this->refunds;
    }

    /**
     * @return string|null
     */
    public function getRecurrentToken(): ?string
    {
        return $this->recurrent_token;
    }

    /**
     * @return CustomerInteractionContainer|null
     */
    public function getCustomerInteraction(): ?CustomerInteractionContainer
    {
        return $this->customer_interaction;
    }

    /**
     * @return string|null
     */
    public function getMetadata(): ?string
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
     * @return bool
     */
    public function isSucceeded(): bool
    {
        return $this->status === AcquiringPaymentStatusEnum::SUCCEEDED;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        return $this->status === AcquiringPaymentStatusEnum::IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === AcquiringPaymentStatusEnum::PENDING;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->status === AcquiringPaymentStatusEnum::FAILED;
    }
}