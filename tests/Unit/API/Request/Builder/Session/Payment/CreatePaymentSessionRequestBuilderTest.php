<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payment;

use Bank131\SDK\API\Request\Builder\Session\Payment\CreatePaymentSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\BankAccount\BankAccountUpi;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Collection\RevenueSplitInfoCollection;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Enum\CurrencyEnum;
use Bank131\SDK\DTO\InternetBanking\AbstractInternetBanking;
use Bank131\SDK\DTO\InternetBanking\InternetBankingEnum;
use Bank131\SDK\DTO\InternetBanking\SberPay;
use Bank131\SDK\DTO\InternetBanking\SberPayChannelEnum;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\InternetBankingPaymentMethod;
use Bank131\SDK\DTO\PaymentOptions;
use Bank131\SDK\DTO\RevenueSplitInfo\RevenueSplitInfoItem;
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

        $customerMock       = $this->createMock(Customer::class);
        $paymentOptionsMock = $this->createMock(PaymentOptions::class);
        $recipientMock      = $this->createMock(Participant::class);
        $senderMock         = $this->createMock(Participant::class);

        $expectedRequest = new CreateSessionRequest();
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
            ->setCard($bankCardMock)
            ->setCustomer($customerMock)
            ->setPaymentOptions($paymentOptionsMock)
            ->setRecipient($recipientMock)
            ->setSender($senderMock)
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->setPaymentMetadata(['key2' => 'value2'])
            ->build();

        $this->assertInstanceOf(CreateSessionRequest::class, $request);
        $this->assertEquals($expectedRequest, $request);
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

    /** @dataProvider internetBankingData */
    public function testSuccessInternetBankingSession(AbstractInternetBanking $internetBankingPaymentMethod): void
    {
        $customer        = $this->createMock(Customer::class);
        $expectedRequest = new CreateSessionRequest();
        $expectedRequest->setAmount(new Amount(100, CurrencyEnum::RUB));
        $expectedRequest->setCustomer($customer);
        $expectedRequest->setPaymentDetails(
            new PaymentDetails(
                new InternetBankingPaymentMethod($internetBankingPaymentMethod)
            )
        );

        $request = $this->builder
            ->setInternetBanking($internetBankingPaymentMethod)
            ->setCustomer($customer)
            ->setAmount(100, CurrencyEnum::RUB)
            ->build();
        $this->assertEquals($expectedRequest, $request);
    }

    public function internetBankingData(): iterable
    {
        $phone            = '9999999999';
        $internetBankings = [
            InternetBankingEnum::SBER_PAY => [
                new SberPay(SberPayChannelEnum::APP, null),
                new SberPay(SberPayChannelEnum::APP, $phone),
                new SberPay(SberPayChannelEnum::MOBILE_WEB, null),
                new SberPay(SberPayChannelEnum::MOBILE_WEB, $phone),
                new SberPay(SberPayChannelEnum::WEB, null),
                new SberPay(SberPayChannelEnum::WEB, $phone),
            ],
        ];

        foreach ($internetBankings as $internetBanking) {
            foreach ($internetBanking as $data) {
                yield [$data];
            }
        }
    }

    public function testCreateSessionWithRevenueSplitInfo(): void
    {
        $request = $this->builder
            ->setRevenueSplitInfo(
                new RevenueSplitInfoCollection([
                    new RevenueSplitInfoItem('test1', '10'),
                    new RevenueSplitInfoItem('test2', null, true),
                ])
            )
            ->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
    }
}
