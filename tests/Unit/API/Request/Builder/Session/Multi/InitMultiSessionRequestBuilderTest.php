<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Multi;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\API\Request\Builder\Session\Multi\InitMultiSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\InitMultiSessionRequest;
use Bank131\SDK\API\Request\Session\InitPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
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
        $paymentBuilder = (new RequestBuilderFactory())->initPaymentSession();
        $payoutBuilder = (new RequestBuilderFactory())->initPayoutSession();

        $request = $this->builder
            ->addPaymentRequestBuilder(
                $paymentBuilder->makeFasterPaymentSystem()
                    ->setAmount(100, 'usd')
                    ->setCustomer(new Customer('test'))
            )
            ->addPayoutRequestBuilder(
                $payoutBuilder->setWallet(new SteamWallet('test'))
                    ->setAmount(9900, 'rub')
                    ->setRecipient((function() {
                        $r = new Participant();
                        $r->setFullName('Full Name');

                        return $r;
                    })())
            )
            ->build();

        $this->assertInstanceOf(InitMultiSessionRequest::class, $request);

        $buildedPayment = (function () { return $this->payment_list[0]; })->call($request);
        $buildedPayout = (function () { return $this->payout_list[0]; })->call($request);

        $this->assertInstanceOf(InitPaymentSessionRequest::class, $buildedPayment);
        $this->assertInstanceOf(InitPayoutSessionRequest::class, $buildedPayout);
    }
}
