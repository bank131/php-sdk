<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\DTO\Amount;

class CapturePaymentSessionRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $session_id;

    /**
     * @var Amount
     */
    private $amount_details;

    public function __construct(
        string $sessionId,
        ?Amount $amount = null
    ) {
        $this->session_id = $sessionId;
        $this->amount_details = $amount;
    }
}
