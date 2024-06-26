<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Response\Fps\FpsBanksListResponse;

class FpsApi extends AbstractApi
{
    protected const BASE_URI = 'api/v1/fps';

    public function getBanks(): FpsBanksListResponse
    {
        /** @var FpsBanksListResponse $response */
        $response = $this->request(
            HttpVerbEnum::GET,
            self::BASE_URI . '/banks',
            FpsBanksListResponse::class
        );

        return $response;
    }
}
