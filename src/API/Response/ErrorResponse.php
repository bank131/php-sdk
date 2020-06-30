<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response;

use Bank131\SDK\DTO\Error;

class ErrorResponse extends AbstractResponse
{
    /**
     * @var Error
     */
    private $error;

    /**
     * @return Error|null
     */
    public function getError(): ?Error
    {
        return $this->error;
    }
}