<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\Payment\CreatePaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\DTO\BankAccount\BankAccountEnum;
use Bank131\SDK\DTO\BankAccount\BankAccountRu;
use Bank131\SDK\DTO\BankAccount\BankAccountUpi;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\PaymentOptions;
use PHPUnit\Framework\TestCase;

class CreatePaymentSessionRequestBuilderTest extends TestCase
{
    /**
     * @var CreatePaymentSessionRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new CreatePaymentSessionRequestBuilder();
    }

    public function testSuccessBuildEmptySession(): void
    {
        $request = $this->builder->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
    }

    public function testSuccessBuildCardSession(): void
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
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
    }

    public function testSuccessBankAccountSession(): void
    {
        $request = $this->builder
            ->setBankAccount(new BankAccountUpi())
            ->setCustomer($this->createMock(Customer::class))
            ->setAmount(100, 'rub')
            ->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
    }
}