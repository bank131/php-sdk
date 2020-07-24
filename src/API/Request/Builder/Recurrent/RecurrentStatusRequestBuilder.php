<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Recurrent;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Recurrent\RecurrentStatusRequest;
use Bank131\SDK\Exception\InvalidArgumentException;

class RecurrentStatusRequestBuilder extends RecurrentRequestBuilder
{
    /**
     * @return RecurrentStatusRequest
     */
    public function build(): AbstractRequest
    {
        if (!$this->recurrentDetails) {
            throw new InvalidArgumentException('recurrentDetails are not defined');
        }

        return new RecurrentStatusRequest($this->recurrentDetails);
    }
}
