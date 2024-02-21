<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\SberPay;

use Bank131\SDK\API\Request\AbstractRequest;

class SberPayPushRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $session_id;

    /**
     * @param string $phone
     * @param string $session_id
     */
     public function __construct(string $phone, string $session_id)
    {
        $this->phone = $phone;
        $this->session_id = $session_id;
    }
}
