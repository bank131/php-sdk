<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Widget;

use Bank131\SDK\API\Response\AbstractResponse;

class PublicTokenResponse extends AbstractResponse
{
    /**
     * @var string
     */
    private $public_token;

    /**
     * @return string
     */
    public function getPublicToken(): string
    {
        return $this->public_token;
    }
}