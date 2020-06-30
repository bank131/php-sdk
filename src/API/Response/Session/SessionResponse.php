<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Session;

use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\DTO\Session;

class SessionResponse extends AbstractResponse
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }
}