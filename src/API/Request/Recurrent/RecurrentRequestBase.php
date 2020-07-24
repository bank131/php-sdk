<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Recurrent;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\DTO\Recurrent\RecurrentDetailsMethod;

abstract class RecurrentRequestBase extends AbstractRequest
{
    /**
     * @var RecurrentDetailsMethod
     */
    private $recurrent;

    /**
     * RecurrentStatusRequest constructor.
     *
     * @param RecurrentDetailsMethod $recurrent
     */
    public function __construct(RecurrentDetailsMethod $recurrent)
    {
        $this->recurrent = $recurrent;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->recurrent->getToken();
    }
}
