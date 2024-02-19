<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Session;

use Bank131\SDK\API\Request\Confirm\ConfirmInformation;
use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\DTO\Session;

class SessionResponse extends AbstractResponse
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var ConfirmInformation|null
     */
    private $confirm_information;

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    public function getConfirmInformation(): ?ConfirmInformation
    {
        return $this->confirm_information;
    }
}