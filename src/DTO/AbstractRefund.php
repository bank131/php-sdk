<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\DTO\Collection\RevenueSplitInfoCollection;
use Bank131\SDK\DTO\Enum\AcquiringPaymentRefundStatusEnum;
use DateTimeImmutable;

/**
 * @internal
 */
class AbstractRefund
{
    /**
     * @var string
     * @final
     */
    protected $id;

    /**
     * @var string
     * @final
     */
    protected $status;

    /**
     * @var DateTimeImmutable
     * @final
     */
    protected $created_at;

    /**
     * @var DateTimeImmutable|null
     * @final
     */
    protected $finished_at;

    /**
     * @var Amount
     * @final
     */
    protected $amount_details;

    /**
     * @var mixed
     * @final
     */
    protected $metadata;

    /**
     * @var boolean|null
     * @final
     */
    protected $is_chargeback;

    /**
     * @var Amounts
     * @final
     */
    protected $amounts;

    /**
     * @var RevenueSplitInfoCollection|null
     * @final
     */
    protected $revenue_split_info;

    /**
     * @var TransactionInfo
     */
    protected $transaction_info;

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
     * @return Amount
     */
    public function getAmountDetails(): Amount
    {
        return $this->amount_details;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->status === AcquiringPaymentRefundStatusEnum::ACCEPTED;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        return $this->status === AcquiringPaymentRefundStatusEnum::IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isDeclined(): bool
    {
        return $this->status === AcquiringPaymentRefundStatusEnum::DECLINED;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->status === AcquiringPaymentRefundStatusEnum::ERROR;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    public function getIsChargeback(): bool
    {
        return $this->is_chargeback === true;
    }

    /**
     * @return Amounts
     */
    public function getAmounts(): Amounts
    {
        return $this->amounts;
    }

    public function getRevenueSplitInfo(): ?RevenueSplitInfoCollection
    {
        return $this->revenue_split_info;
    }

    public function getTransactionInfo(): ?TransactionInfo
    {
        return $this->transaction_info;
    }
}
