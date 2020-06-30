<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook\Hook;

use Bank131\SDK\DTO\Session;

abstract class AbstractWebHook
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }
}