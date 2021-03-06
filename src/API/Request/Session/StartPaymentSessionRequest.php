<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

class StartPaymentSessionRequest extends AbstractSessionRequest
{
    /**
     * StartSessionRequest constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->setSessionId($sessionId);
    }
}