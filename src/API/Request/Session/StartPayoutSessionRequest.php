<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

class StartPayoutSessionRequest extends AbstractSessionRequest
{
    /**
     * StartPayoutSessionRequest constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->setSessionId($sessionId);
    }
}