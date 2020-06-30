<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\API\Response\Enum\ResponseStatusEnum;
use Bank131\SDK\DTO\WalletDetails;
use GuzzleHttp\Psr7\Response;

class WalletApiTest extends AbstractApiTest
{
    public function testWalletBalance(): void
    {
        $expectedResponseBody = [
            'status' => ResponseStatusEnum::OK,
            "wallets" => [
                [
                    "id"=> $walletId = "131",
                    "amount_details"=> [
                        "amount"=> $walletAmount = 13100,
                        "currency"=> $walletCurrency = "rub"
                    ]
                ]
            ]
        ];
        
        $client = $this->createClientWithMockResponse([
            new Response(200, [], json_encode($expectedResponseBody))
        ]);

        $walletBalanceResponse = $client->wallet()->balance();

        $this->assertTrue($walletBalanceResponse->isOk());

        $this->assertIsIterable($walletBalanceResponse->getWallets());
        $this->assertCount(1, $walletBalanceResponse->getWallets());

        /** @var WalletDetails $wallet */
        $wallet = $walletBalanceResponse->getWallets()->get(0);

        $this->assertEquals($walletId, $wallet->getId());
        $this->assertEquals($walletAmount, $wallet->getAmountDetails()->getAmount());
        $this->assertEquals($walletCurrency, $wallet->getAmountDetails()->getCurrency());
    }
}