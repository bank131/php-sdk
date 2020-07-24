<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\Payment\StartPaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\StartPaymentSessionRequest;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\PaymentOptions;
use PHPUnit\Framework\TestCase;

class StartPaymentSessionRequestBuilderTest extends TestCase
{
    /**
     * @var StartPaymentSessionRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new StartPaymentSessionRequestBuilder('session_id');
    }

    public function testSuccessBuildEmptySession(): void
    {
        $request = $this->builder->build();
        $this->assertInstanceOf(StartPaymentSessionRequest::class, $request);
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
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
        $this->assertInstanceOf(StartPaymentSessionRequest::class, $request);
    }
}
