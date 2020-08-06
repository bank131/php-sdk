<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Recurrent;

use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\DTO\Recurrent\RecurrentDetails;

/**
 * Class RecurrentStatusResponse
 *
 * @psalm-suppress MissingConstructor
 */
class RecurrentStatusResponse extends AbstractResponse
{
    /**
     * @var RecurrentDetails
     */
    private $recurrent;

    /**
     * @return RecurrentDetails
     */
    public function getRecurrent(): RecurrentDetails
    {
        return $this->recurrent;
    }
}
