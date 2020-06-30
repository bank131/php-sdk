<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder;

use Bank131\SDK\API\Request\AbstractRequest;

abstract class AbstractBuilder
{
    /**
     * @return AbstractRequest
     */
    abstract public function build(): AbstractRequest;
}