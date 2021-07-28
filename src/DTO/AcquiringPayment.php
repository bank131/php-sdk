<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\AcquiringPaymentRefundCollection;
use Bank131\SDK\DTO\CustomerInteraction\CustomerInteractionContainer;
use Bank131\SDK\DTO\Enum\AcquiringPaymentStatusEnum;
use Bank131\SDK\DTO\Recurrent\RecurrentDetails;
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
     * @var Amounts
     */
    private $amounts;

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
     * @var RecurrentDetails|null
     */
    private $recurrent;

    /**
     * @var CustomerInteractionContainer|null
     */
    private $customer_interaction;

    /**
     * @var mixed
     */
    private $metadata;

    /**
     * @var Subscription|null
     */
    private $subscription;

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
     * @return Amounts
     */
    public function getAmounts(): Amounts
    {
        return $this->amounts;
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
     * @return RecurrentDetails|null
     */
    public function getRecurrent(): ?RecurrentDetails
    {
        return $this->recurrent;
    }

    /**
     * @return CustomerInteractionContainer|null
     */
    public function getCustomerInteraction(): ?CustomerInteractionContainer
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
     * @return Subscription|null
     */
    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
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
