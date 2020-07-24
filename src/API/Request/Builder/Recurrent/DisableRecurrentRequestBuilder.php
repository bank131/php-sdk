<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Recurrent;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Recurrent\DisableRecurrentRequest;
use Bank131\SDK\Exception\InvalidArgumentException;

class DisableRecurrentRequestBuilder extends RecurrentRequestBuilder
{
    /**
     * @return DisableRecurrentRequest
     */
    public function build(): AbstractRequest
    {
        if (!$this->recurrentDetails) {
            throw new InvalidArgumentException('recurrentDetails are not defined');
        }

        return new DisableRecurrentRequest($this->recurrentDetails);
    }
}
