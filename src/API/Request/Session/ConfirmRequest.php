<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\API\Request\Confirm\ConfirmInformation;

class ConfirmRequest extends SessionIdRequest
{
    /**
     * @var ConfirmInformation|null
     */
    private $confirm_information;

    public function __construct(string $sessionId, ?ConfirmInformation $confirmInformation = null)
    {
        parent::__construct($sessionId);
        $this->setConfirmInformation($confirmInformation);
    }

    public function setConfirmInformation(?ConfirmInformation $confirm_information): void
    {
        $this->confirm_information = $confirm_information;
    }
}