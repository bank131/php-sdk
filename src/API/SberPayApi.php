<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\SberPay\SberPayPushRequest;
use Bank131\SDK\API\Response\SberPay\SberPayPushResponse;

class SberPayApi extends AbstractApi
{
    protected const BASE_URI = '/api/v1/sberpay';

    /**
     * @param SberPayPushRequest $request
     *
     * @return SberPayPushResponse
     */
    public function sberPayPush(SberPayPushRequest $request): SberPayPushResponse
    {
        /** @var SberPayPushResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/push',
            SberPayPushResponse::class,
            $request
        );

        return $response;
    }
}
