<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

class ChargebackPaymentSessionRequest extends AbstractSessionRequest
{
    public function __construct(string $sessionId)
    {
        $this->setSessionId($sessionId);
    }
}
