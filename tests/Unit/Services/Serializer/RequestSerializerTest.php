<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Serializer;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\DTO\BankAccount\BankAccountFPS;
use Bank131\SDK\DTO\BankAccount\BankAccountRu;
use Bank131\SDK\DTO\Participant;

class RequestSerializerTest extends JsonSerializerTest
{
    public function testPayoutFpsSerialize()
    {
        $sessionRequest = RequestBuilderFactory::create()
            ->createPayoutSession()
            ->setBankAccount(
                new BankAccountFPS(
                    '0070009210197',
                    '100000000197',
                    'Перевод средств по договору'
                )
            )
            ->build();

        $jsonString = $this->serializer->serialize($sessionRequest);
        $expected = [
            "payout_details" => [
                "type" => "bank_account",
                "bank_account" => [
                    "system_type" => "faster_payment_system",
                    "faster_payment_system" => [
                        "phone" => "0070009210197",
                        "bank_id" => "100000000197",
                        "description" => "Перевод средств по договору"
                    ]
                ]
            ]
        ];

        self::assertEquals(json_encode($expected), $jsonString);
    }

    public function testPaymentFpsPaymentMethodSerialize()
    {
        $sessionRequest = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->makeFasterPaymentSystem()
            ->build();

        $jsonString = $this->serializer->serialize($sessionRequest);
        $expected = [
            "payment_details" => [
                "type" => "faster_payment_system"
            ]
        ];

        self::assertEquals(json_encode($expected), $jsonString);
    }

    public function testPayoutBankAccountRuSerialize()
    {
        $sessionRequest = RequestBuilderFactory::create()
            ->createPayoutSession()
            ->setBankAccount(
                new BankAccountRu(
                    '123123',
                    '123131',
                    'fullName',
                    'description',
                    false,
                    '123123331'
                )
            )
            ->build();

        $jsonString = $this->serializer->serialize($sessionRequest);
        $expected = [
            "payout_details" => [
                "type" => "bank_account",
                "bank_account" => [
                    "system_type" => "ru",
                    "ru" => [
                        "bik" => "123123",
                        "account" => "123131",
                        "full_name" => "fullName",
                        "description" => "description",
                        "is_fast" => false,
                        'inn' => '123123331'
                    ]
                ]
            ]
        ];

        self::assertEquals(json_encode($expected), $jsonString);
    }

    public function testPayoutParticipantSerialize()
    {
        $participant = new Participant();
        $participant->setBeneficiaryId('121231');
        $sessionRequest = RequestBuilderFactory::create()
            ->createPayoutSession()
            ->setBankAccount(
                new BankAccountRu(
                    '123123',
                    '123131',
                    'fullName',
                    'description',
                    false,
                    '123123331'
                )
            )
            ->setSender($participant)
            ->build();

        $jsonString = $this->serializer->serialize($sessionRequest);
        $expected = [
            "payout_details" => [
                "type" => "bank_account",
                "bank_account" => [
                    "system_type" => "ru",
                    "ru" => [
                        "bik" => "123123",
                        "account" => "123131",
                        "full_name" => "fullName",
                        "description" => "description",
                        "is_fast" => false,
                        "inn" => "123123331"
                    ]
                ]
            ],
            "participant_details" => [
                "sender" => [
                    "beneficiary_id" => "121231"
                ]
            ]
        ];

        self::assertEquals(json_encode($expected), $jsonString);
    }
}