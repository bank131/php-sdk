<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\DTO\FiscalizationDetails;

class StartPayoutSessionRequestWithFiscalization extends AbstractSessionRequest
{
    /**
     * @var FiscalizationDetails
     */
    private $fiscalization_details;

    /**
     * StartSessionRequest constructor.
     *
     * @param string               $sessionId
     * @param FiscalizationDetails $fiscalizationDetails
     */
    public function __construct(string $sessionId, FiscalizationDetails $fiscalizationDetails)
    {
        $this->setSessionId($sessionId);

        $this->fiscalization_details = $fiscalizationDetails;
    }
}