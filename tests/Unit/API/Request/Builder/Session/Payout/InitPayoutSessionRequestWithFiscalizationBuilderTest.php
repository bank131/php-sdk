<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\Builder\Session\Payout\InitPayoutSessionWithFiscalizationRequestBuilder;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\DTO\BankAccount\BankAccountEnum;
use Bank131\SDK\DTO\BankAccount\BankAccountRu;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Card\EncryptedCard;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\ProfessionalIncomeTaxpayer;
use Bank131\SDK\DTO\Wallet\AbstractWallet;
use Bank131\SDK\DTO\Wallet\MonetaWallet;
use Bank131\SDK\DTO\Wallet\QiwiWallet;
use Bank131\SDK\DTO\Wallet\SteamWallet;
use Bank131\SDK\DTO\Wallet\TelegramWallet;
use Bank131\SDK\DTO\Wallet\WalletEnum;
use Bank131\SDK\DTO\Wallet\YoomoneyWallet;
use Bank131\SDK\Exception\InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InitPayoutSessionRequestWithFiscalizationBuilderTest extends TestCase
{
    /**
     * @var InitPayoutSessionWithFiscalizationRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new InitPayoutSessionWithFiscalizationRequestBuilder();
    }

    public function testFailedBuildEmptySession(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder->build();
    }

    public function testFailedBuildSessionWithoutIncomeInfo(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setCard(
                $this->createMock(EncryptedCard::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setAmount(1000, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
    }


    public function testFailedBuildSessionWithoutAmount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setCard(
                $this->createMock(EncryptedCard::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
    }

    public function testFailedBuildSessionWithoutParticipantDetails(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setCard(
                $this->createMock(EncryptedCard::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setAmount(1000, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
    }

    public function testFailedBuildSessionWithoutRecipientFullName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setCard(
                $this->createMock(EncryptedCard::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setAmount(1000, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
    }

    public function testFailedBuildSessionWithoutPayoutMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setAmount(1000, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
    }

    public function testSuccessFullSession(): void
    {
        $recipient = new Participant();
        $recipient->setFullName('Recipient Full Name');

        $bankCardMock = $this->createMock(BankCard::class);
        $bankCardMock->method('getType')->willReturn(CardEnum::BANK_CARD);

        $request = $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setCard($bankCardMock)
            ->setRecipient($recipient)
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setAmount(1000, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();

        $this->assertInstanceOf(InitPayoutSessionRequest::class, $request);
    }


    public function walletProvider(): array
    {
        return [
            [new QiwiWallet('+79999999999')],
            [new YoomoneyWallet('4100175017397')],
            [new MonetaWallet('88888888')],
            [new SteamWallet('username')],
            [new TelegramWallet('username')],
        ];
    }

    /**
     * @dataProvider walletProvider
     */
    public function testSuccessBuildWalletSession(AbstractWallet $wallet): void
    {
        $recipient = new Participant();
        $recipient->setFullName('Recipient Full Name');

        $request = $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setWallet($wallet)
            ->setAmount(1000, 'rub')
            ->setRecipient($recipient)
            ->build();

        $this->assertInstanceOf(InitPayoutSessionRequest::class, $request);
    }


    public function testSuccessBuildCardTokenizedSession(): void
    {
        $recipient = new Participant();
        $recipient->setFullName('Recipient Full Name');

        $bankCardMock = $this->createMock(BankCard::class);
        $bankCardMock->method('getType')->willReturn(CardEnum::BANK_CARD);

        $request = $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setCard($bankCardMock)
            ->setRecipient($recipient)
            ->setAmount(1000, 'rub')
            ->build();

        $this->assertInstanceOf(InitPayoutSessionRequest::class, $request);
    }

    public function testSuccessBuildCardAsIsSession(): void
    {
        $recipient = new Participant();
        $recipient->setFullName('Recipient Full Name');

        $bankCardMock = $this->createMock(BankCard::class);
        $bankCardMock->method('getType')->willReturn(CardEnum::BANK_CARD);

        $request = $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setCard($bankCardMock)
            ->setRecipient($recipient)
            ->setAmount(1000, 'rub')
            ->build();

        $this->assertInstanceOf(InitPayoutSessionRequest::class, $request);
    }

    public function testSuccessBuildRussianAccountSession(): void
    {
        $recipient = new Participant();
        $recipient->setFullName('Recipient Full Name');

        $bankAccountMock = $this->createMock(BankAccountRu::class);
        $bankAccountMock->method('getType')->willReturn(BankAccountEnum::RU);

        $request = $this->builder
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setBankAccount($bankAccountMock)
            ->setRecipient($recipient)
            ->setAmount(1000, 'rub')
            ->build();

        $this->assertInstanceOf(InitPayoutSessionRequest::class, $request);
    }
}
