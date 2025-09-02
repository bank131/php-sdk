<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\Amount;

class CapturePaymentSessionRequest extends AbstractSessionRequest
{
    public function __construct(
        string $sessionId,
        ?Amount $amount = null
    ) {
        $this->setSessionId($sessionId);
        if ($amount !== null) {
            $this->setAmount($amount);
        }
    }
}
