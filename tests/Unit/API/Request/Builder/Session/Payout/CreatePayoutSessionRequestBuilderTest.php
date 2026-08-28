<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\Builder\Session\Payout\CreatePayoutSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\DTO\BankAccount\BankAccountEnum;
use Bank131\SDK\DTO\BankAccount\BankAccountRu;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
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
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreatePayoutSessionRequestBuilderTest extends TestCase
{
    /**
     * @var CreatePayoutSessionRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new CreatePayoutSessionRequestBuilder();
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
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
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
        $request = $this->builder
            ->setWallet($wallet)
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
    }

    public function testSuccessBuildBankAccountSession(): void
    {
        $bankAccountMock = $this->createMock(BankAccountRu::class);
        $bankAccountMock->method('getType')->willReturn(BankAccountEnum::RU);

        $request = $this->builder
            ->setBankAccount($bankAccountMock)
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setIncomeInformation(
                $this->createMock(ProfessionalIncomeTaxpayer::class)
            )
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
        $this->assertInstanceOf(CreateSessionRequest::class, $request);
    }
}
