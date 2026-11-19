<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class TransactionInfo
{
    private $rrn;

    private $arn;

    private $auth_code;

    private $fp_message_id;

    private $external_subscription_token;

    private $bank_account_ru_token;

    private $sbp_member_id;

    public function __construct(
        ?string $rrn,
        ?string $arn = null,
        ?string $authCode = null,
        ?string $fpMessageId = null,
        ?string $externalSubscriptionToken = null,
        ?string $bankAccountRuToken = null,
        ?string $sbpMemberId = null
    ) {
        $this->rrn = $rrn;
        $this->arn = $arn;
        $this->auth_code = $authCode;
        $this->fp_message_id = $fpMessageId;
        $this->external_subscription_token = $externalSubscriptionToken;
        $this->bank_account_ru_token = $bankAccountRuToken;
        $this->sbp_member_id = $sbpMemberId;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getArn(): ?string
    {
        return $this->arn;
    }

    public function getAuthCode(): ?string
    {
        return $this->auth_code;
    }

    public function getFpMessageId(): ?string
    {
        return $this->fp_message_id;
    }

    public function getExternalSubscriptionToken(): ?string
    {
        return $this->external_subscription_token;
    }

    public function getBankAccountRuToken(): ?string
    {
        return $this->bank_account_ru_token;
    }

    public function getSbpMemberId(): ?string
    {
        return $this->sbp_member_id;
    }
}
