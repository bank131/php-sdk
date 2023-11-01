<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\Payment\StartPaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\StartPaymentSessionRequest;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
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

        $customerMock = $this->createMock(Customer::class);
        $paymentOptionsMock = $this->createMock(PaymentOptions::class);
        $recipientMock = $this->createMock(Participant::class);
        $senderMock = $this->createMock(Participant::class);

        $expectedRequest = new StartPaymentSessionRequest('session_id');
        $expectedRequest->setPaymentDetails(
            new PaymentDetails(
                new CardPaymentMethod($bankCardMock)
            )
        );
        $expectedRequest->setAmount(new Amount(100, 'rub'));
        $expectedRequest->setMetadata('{"key":"value"}');
        $expectedRequest->setPaymentMetadata(['key2' => 'value2']);
        $expectedRequest->setCustomer($customerMock);
        $expectedRequest->setPaymentOptions($paymentOptionsMock);
        $participantDetails = new ParticipantDetails();
        $participantDetails->setSender($senderMock);
        $participantDetails->setRecipient($recipientMock);
        $expectedRequest->setParticipantDetails($participantDetails);

        $request = $this->builder
            ->setPaymentMetadata(['key2' => 'value2'])
            ->setCard($bankCardMock)
            ->setCustomer($customerMock)
            ->setPaymentOptions($paymentOptionsMock)
            ->setRecipient($recipientMock)
            ->setSender($senderMock)
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();

        $this->assertInstanceOf(StartPaymentSessionRequest::class, $request);
        $this->assertEquals($expectedRequest, $request);
    }
}
