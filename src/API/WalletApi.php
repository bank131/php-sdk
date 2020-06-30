<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Wallet\WalletBalanceRequest;
use Bank131\SDK\API\Response\Wallet\WalletBalanceResponse;

class WalletApi extends AbstractApi
{
    protected const BASE_URI = 'api/v1/wallet';

    /**
     * @return WalletBalanceResponse
     */
    public function balance(): WalletBalanceResponse
    {
        $request = new WalletBalanceRequest();

        /** @var WalletBalanceResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/balance',
            WalletBalanceResponse::class,
            $request
        );

        return $response;
    }
}