<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Functional;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\Client;
use Bank131\SDK\Config;
use Bank131\SDK\DTO\AcquiringPayment;
use Bank131\SDK\DTO\AcquiringPaymentRefund;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\PaymentOptions;
use PHPUnit\Framework\TestCase;

class SessionApiPaymentsTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp(): void
    {
        $config = new Config(
            'http://playground.bank131.ru:8081',
            'shop-andreev',
            file_get_contents(__DIR__ . '/../Fixtures/keys/private.pem')
        );
        $this->client = new Client($config);
    }

    public function testCreateSession(): void
    {
        $sessionRequest = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->build();

        $sessionResponse = $this->client->session()->create($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());

        $this->assertNotNull($session = $sessionResponse->getSession());

        $this->assertNotNull($session->getId());
        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull($session->getUpdatedAt());
        $this->assertTrue($session->isCreated());
    }

    public function testInitPaymentSession(): void
    {
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl($returnUrl = 'http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->initPaymentSession()
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionResponse = $this->client->session()->initPayment($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());

        $this->assertNotNull($session = $sessionResponse->getSession());

        $this->assertNotNull($session->getId());
        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull( $session->getUpdatedAt());
        $this->assertTrue($session->isInProgress());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertTrue($acquiringPayment->isInProgress());
        $this->assertNotNull($acquiringPayment->getId());
        $this->assertNotNull($acquiringPayment->getStatus());
        $this->assertNotNull($acquiringPayment->getCreatedAt());
        $this->assertNotNull($acquiringPayment->getCustomer());
        $this->assertEquals($reference, $acquiringPayment->getCustomer()->getReference());
        $this->assertEquals($amountValue, $acquiringPayment->getAmountDetails()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmountDetails()->getCurrency());
        $this->assertEquals(json_encode($metadata), $acquiringPayment->getMetadata());
        $this->assertEquals($returnUrl, $acquiringPayment->getPaymentOptions()->getReturnUrl());
    }

    public function testStartSession(): void
    {
        //1-st step: CREATE SESSION
        $sessionRequest = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->build();

        $sessionCreateResponse = $this->client->session()->create($sessionRequest);

        $this->assertTrue($sessionCreateResponse->isOk());
        $this->assertNotNull($session = $sessionCreateResponse->getSession());

        //2-nd step: START SESSION
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl($returnUrl = 'http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->startPaymentSession($session->getId())
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionStartResponse = $this->client->session()->startPayment($sessionRequest);

        $this->assertTrue($sessionStartResponse->isOk());
        $this->assertNotNull($session = $sessionStartResponse->getSession());

        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull($session->getUpdatedAt());
        $this->assertGreaterThan($session->getCreatedAt(), $session->getUpdatedAt());
        $this->assertTrue($session->isInProgress());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertTrue($acquiringPayment->isInProgress());
        $this->assertNotNull($acquiringPayment->getId());
        $this->assertNotNull($acquiringPayment->getStatus());
        $this->assertNotNull($acquiringPayment->getCreatedAt());
        $this->assertNotNull($acquiringPayment->getCustomer());
        $this->assertEquals($reference, $acquiringPayment->getCustomer()->getReference());
        $this->assertEquals($amountValue, $acquiringPayment->getAmountDetails()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmountDetails()->getCurrency());
        $this->assertEquals(json_encode($metadata), $acquiringPayment->getMetadata());
        $this->assertEquals($returnUrl, $acquiringPayment->getPaymentOptions()->getReturnUrl());
    }

    public function testConfirmSession(): void
    {
        //1-st step: CREATE AND START SESSION
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl('http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->initPaymentSession()
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionResponse = $this->client->session()->initPayment($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());
        $this->assertNotNull($session = $sessionResponse->getSession());

        sleep(15);

        //2-nd step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());
        $this->assertNotNull($session = $sessionStatusResponse->getSession());

        $this->assertTrue($session->hasNextAction());
        $this->assertEquals('confirm', $session->getNextAction());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertTrue($acquiringPayment->isPending());

        //3-rd step: CONFIRM SESSION
        $confirmedSessionResponse = $this->client->session()->confirm($session->getId());

        $this->assertTrue($confirmedSessionResponse->isOk());
        $this->assertNotNull($session = $confirmedSessionResponse->getSession());

        $this->assertFalse($session->hasNextAction());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertTrue($acquiringPayment->isInProgress());
    }

    public function testCancelSession(): void
    {
        //1-st step: CREATE AND START SESSION
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl('http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->initPaymentSession()
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionResponse = $this->client->session()->initPayment($sessionRequest);

        $this->assertTrue( $sessionResponse->isOk());
        $this->assertNotNull($session = $sessionResponse->getSession());

        $this->assertTrue($session->isInProgress());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertTrue($acquiringPayment->isInProgress());

        sleep(10);

        //2-nd step: CANCEL SESSION
        $cancelSessionResponse = $this->client->session()->cancel($session->getId());

        $this->assertTrue($cancelSessionResponse->isOk());
        $this->assertNotNull($session = $cancelSessionResponse->getSession());

        sleep(5);

        //3-rd step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());
        $this->assertNotNull($session = $sessionStatusResponse->getSession());

        $this->assertNotNull($session->getError());
        $this->assertTrue($session->isCancelled());
    }

    public function testStatusSession(): void
    {
        //1-st step: CREATE AND START SESSION
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl('http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->initPaymentSession()
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionResponse = $this->client->session()->initPayment($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());

        $this->assertNotNull($session = $sessionResponse->getSession());

        sleep(15);

        //2-nd step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($sessionId =$session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());
        $this->assertNotNull($session = $sessionStatusResponse->getSession());

        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull( $session->getUpdatedAt());
        $this->assertEquals($sessionId, $session->getId());
        $this->assertTrue($session->isInProgress());
        $this->assertTrue($session->hasNextAction());
        $this->assertEquals('confirm', $session->getNextAction());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertTrue($acquiringPayment->isPending());
    }

    public function testCaptureSession(): void
    {
        //1-st step: CREATE AND START SESSION
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl($returnUrl = 'http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->initPaymentSession()
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionResponse = $this->client->session()->initPayment($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());
        $this->assertNotNull($session = $sessionResponse->getSession());
        $this->assertTrue($session->isInProgress());

        sleep(15);

        //2-nd step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());

        $this->assertNotNull($session = $sessionStatusResponse->getSession());
        $this->assertTrue($sessionResponse->isOk());

        $this->assertTrue($session->isInProgress());
        $this->assertTrue($session->hasNextAction());
        $this->assertEquals('confirm', $session->getNextAction());

        //3-rd step: CONFIRM SESSION
        $confirmedSessionResponse = $this->client->session()->confirm($session->getId());

        $this->assertTrue($confirmedSessionResponse->isOk());
        $this->assertNotNull($session = $confirmedSessionResponse->getSession());

        sleep(5);

        //4-th step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());
        $this->assertNotNull($session = $sessionStatusResponse->getSession());

        $this->assertTrue($session->isInProgress());
        $this->assertTrue($session->hasNextAction());
        $this->assertEquals('capture', $session->getNextAction());

        //5-th step: CAPTURE SESSION:
        $sessionCaptureResponse = $this->client->session()->capture($session->getId());

        $this->assertTrue($sessionCaptureResponse->isOk());
        $this->assertNotNull($session = $sessionCaptureResponse->getSession());

        $this->assertNotNull($session = $sessionResponse->getSession());
        $this->assertTrue($session->isInProgress());
        $this->assertFalse($session->hasNextAction());
        $this->assertFalse($session->hasNextAction());
    }

    public function testRefundSession(): void
    {
        //1-st step: CREATE AND START SESSION
        $paymentOptions = new PaymentOptions();
        $paymentOptions->setReturnUrl($returnUrl = 'http://bank131.ru');

        $metadata = ['key' => 'value'];

        $sessionRequest = RequestBuilderFactory::create()
            ->initPaymentSession()
            ->setCard(new BankCard('4242424242424242'))
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setPaymentOptions($paymentOptions)
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionResponse = $this->client->session()->initPayment($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());
        $this->assertNotNull($session = $sessionResponse->getSession());
        $this->assertTrue($session->isInProgress());

        sleep(15);

        //2-nd step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());

        $this->assertNotNull($session = $sessionStatusResponse->getSession());
        $this->assertTrue($sessionResponse->isOk());

        $this->assertTrue($session->isInProgress());
        $this->assertTrue($session->hasNextAction());
        $this->assertEquals('confirm', $session->getNextAction());

        //3-rd step: CONFIRM SESSION
        $confirmedSessionResponse = $this->client->session()->confirm($session->getId());

        $this->assertTrue($confirmedSessionResponse->isOk());
        $this->assertNotNull($session = $confirmedSessionResponse->getSession());

        sleep(5);

        //4-th step: CHECK SESSION STATUS
        $sessionStatusResponse = $this->client->session()->status($session->getId());

        $this->assertTrue($sessionStatusResponse->isOk());
        $this->assertNotNull($session = $sessionStatusResponse->getSession());

        $this->assertTrue($session->isInProgress());
        $this->assertTrue($session->hasNextAction());
        $this->assertEquals('capture', $session->getNextAction());

        //5-th step: CAPTURE SESSION:
        $sessionCaptureResponse = $this->client->session()->capture($session->getId());

        $this->assertTrue($sessionCaptureResponse->isOk());
        $this->assertNotNull($session = $sessionCaptureResponse->getSession());

        $this->assertNotNull($session = $sessionResponse->getSession());
        $this->assertTrue($session->isInProgress());
        $this->assertFalse($session->hasNextAction());
        $this->assertFalse($session->hasNextAction());

        sleep(5);

        //6-th step: REFUND SESSION

        $refundRequest = RequestBuilderFactory::create()
            ->refundSession($session->getId())
            ->setAmount($amountValue, $amountCurrency)
            ->setMetadata(json_encode($metadata))
            ->build();

        $refundResponse = $this->client->session()->refund($refundRequest);

        $this->assertNotNull($session = $refundResponse->getSession());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()->get(0);

        $this->assertIsIterable($acquiringPayment->getRefunds());
        $this->assertCount(1, $acquiringPayment->getRefunds());

        /** @var AcquiringPaymentRefund $refund */
        $refund = $acquiringPayment->getRefunds()->get(0);

        $this->assertTrue($refund->isInProgress());
        $this->assertNotNull($refund->getId());
        $this->assertNotNull($refund->getCreatedAt());
        $this->assertEquals($amountValue, $refund->getAmountDetails()->getAmount());
        $this->assertEquals($amountCurrency, $refund->getAmountDetails()->getCurrency());
    }
}