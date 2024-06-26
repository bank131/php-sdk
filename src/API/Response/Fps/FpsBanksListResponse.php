<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Response\Fps;

use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\DTO\Collection\FpsBanksCollection;

class FpsBanksListResponse extends AbstractResponse
{
    /**
     * @var FpsBanksCollection|null
     */
    private $banks;

    public function getBanks(): FpsBanksCollection
    {
        return $this->banks ?? new FpsBanksCollection();
    }
}
