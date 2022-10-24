<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Response\Token;

use Bank131\SDK\API\Response\AbstractResponse;

class TokenInfoResponse extends AbstractResponse
{
    /**
     * @var TokenInfo
     */
    protected $info;

    public function getInfo(): TokenInfo
    {
        return $this->info;
    }
}
