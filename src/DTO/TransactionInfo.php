<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class TransactionInfo
{
    private $rrn;

    private $arn;

    private $auth_code;

    private $fp_message_id;

    public function __construct(
        ?string $rrn,
        ?string $arn = null,
        ?string $authCode = null,
        ?string $fpMessageId = null
    ) {
        $this->rrn           = $rrn;
        $this->arn           = $arn;
        $this->auth_code     = $authCode;
        $this->fp_message_id = $fpMessageId;
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
}
