<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerAuthorization;

class CustomerAuthorizationSms extends CustomerAuthorization
{
    /**
     * @var string
     */
    private $suspendKey;

    /**
     * @var AcceptCode
     */
    private $acceptCode;

    /**
     * @var ResendSms|null
     */
    private $resendSms = null;

    /**
     * @var Error|null
     */
    private $error = null;

    public function __construct(
        string $suspendKey,
        AcceptCode $acceptCode,
        ?ResendSms $resendSms,
        ?Error $error
    ) {
        parent::__construct(CustomerAuthorizationEnum::AUTH_SMS);

        $this->suspendKey = $suspendKey;
        $this->acceptCode = $acceptCode;
        $this->resendSms = $resendSms;
        $this->error = $error;
    }

    public function getSuspendKey(): string
    {
        return $this->suspendKey;
    }

    public function getAcceptCode(): AcceptCode
    {
        return $this->acceptCode;
    }

    public function getResendSms(): ?ResendSms
    {
        return $this->resendSms;
    }

    public function getError(): ?Error
    {
        return $this->error;
    }
}
