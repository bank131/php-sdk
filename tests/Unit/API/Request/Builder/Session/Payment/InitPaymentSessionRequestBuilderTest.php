<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\Payment\InitPaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\InitPaymentSessionRequest;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\PaymentOptions;
use Bank131\SDK\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InitPaymentSessionRequestBuilderTest extends TestCase
{
    /**
     * @var InitPaymentSessionRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new InitPaymentSessionRequestBuilder();
    }

    public function testSuccessBuildFullSession(): void
    {
        $bankCardMock = $this->createMock(BankCard::class);
        $bankCardMock->method('getType')->willReturn(CardEnum::BANK_CARD);

        $request = $this->builder
            ->setCard($bankCardMock)
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setPaymentOptions(
                $this->createMock(PaymentOptions::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setMetadata(json_encode(['key' => 'value']))
            ->setAmount(100, 'rub')
            ->build();

        $this->assertInstanceOf(InitPaymentSessionRequest::class, $request);
    }

    public function testFailedBuildWithoutCard(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setPaymentOptions(
                $this->createMock(PaymentOptions::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setMetadata(json_encode(['key' => 'value']))
            ->setAmount(100, 'rub')
            ->build();
    }

    public function testFailedBuildWithoutCustomer(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setCard(
                $this->createMock(BankCard::class)
            )
            ->setPaymentOptions(
                $this->createMock(PaymentOptions::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setMetadata(json_encode(['key' => 'value']))
            ->setAmount(100, 'rub')
            ->build();
    }

    public function testFailedBuildWithoutAmount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setCard(
                $this->createMock(BankCard::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setPaymentOptions(
                $this->createMock(PaymentOptions::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
    }
}
