<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Recurrent;

use Bank131\SDK\API\Request\Builder\AbstractBuilder;
use Bank131\SDK\DTO\Recurrent\RecurrentDetailsMethod;

abstract class RecurrentRequestBuilder extends AbstractBuilder
{
    /**
     * @var RecurrentDetailsMethod|null
     */
    protected $recurrentDetails;

    /**
     * @param string $token
     *
     * @return self
     */
    public function setRecurrentToken(string $token): self
    {
        $this->recurrentDetails = new RecurrentDetailsMethod($token);

        return $this;
    }
}
