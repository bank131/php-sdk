<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

class StartPaymentSessionRequest extends AbstractSessionRequest
{
    /**
     * @var bool
     */
    private $async = false;

    /**
     * StartSessionRequest constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->setSessionId($sessionId);
    }

    public function setAsync(bool $async): void
    {
        $this->async = $async;
    }
}