<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Multi;

use Bank131\SDK\API\Request\Builder\Session\Multi\InitMultiSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\InitMultiSessionRequest;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\FasterPaymentSystemPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\WalletPaymentMethod;
use Bank131\SDK\DTO\PaymentOptions;
use Bank131\SDK\DTO\Wallet\SteamWallet;
use PHPUnit\Framework\TestCase;

class InitMultiSessionRequestBuilderTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new InitMultiSessionRequestBuilder();
    }

    public function testSuccessBuildCardSession(): void
    {
        $request = $this->builder
            ->addPaymentDetails(new PaymentDetails(new FasterPaymentSystemPaymentMethod()))
            ->addPayoutDetails(new PaymentDetails(new WalletPaymentMethod(new SteamWallet('test'))))
            ->setCustomer($this->createMock(Customer::class))
            ->setRecipient($this->createMock(Participant::class))
            ->setSender($this->createMock(Participant::class))
            ->setAmount(100, 'usd')
            ->setMetadata(json_encode(['key' => 'value']))
            ->setPaymentOptions(new PaymentOptions())
            ->build();
        $this->assertInstanceOf(InitMultiSessionRequest::class, $request);
    }
}
