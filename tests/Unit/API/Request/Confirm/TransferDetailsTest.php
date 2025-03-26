<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Confirm;

use Bank131\SDK\API\Request\Confirm\NominalPaymentParticipant;
use Bank131\SDK\API\Request\Confirm\TransferDetails;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\DTO\PaymentMethod\FasterPaymentSystemPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\RecurrentPaymentMethod;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use PHPUnit\Framework\TestCase;

class TransferDetailsTest extends TestCase
{
    /**
     * @var JsonSerializer
     */
    private $serializer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer = new JsonSerializer();
    }

    public function testCreateV1Version(): void
    {
        $transferDetails = new TransferDetails(
            $customer = new NominalPaymentParticipant('account_number', 'name', 'bank name', 'bi-bik', 'corr_account_number'),
            $recipient = new NominalPaymentParticipant('account_number', 'name', 'bank name', 'bi-bik', 'corr_account_number'),
            $purpose = 'purpose',
            $amount = new Amount(333, 'usd'),
            $paymentMethod = new RecurrentPaymentMethod('card_token', 'merchant')
        );

        $transferDetailsData = json_decode($this->serializer->serialize($transferDetails), true);

        $this->assertArrayNotHasKey('payment_method', $transferDetailsData);
        $this->assertEquals($paymentMethod->getToken(), $transferDetailsData['payout_details']['token']);

        $transferDetailsV1 = $transferDetails->createV1Version();
        $transferDetailsV1Data = json_decode($this->serializer->serialize($transferDetailsV1), true);

        $this->assertInstanceOf(TransferDetails::class, $transferDetailsV1);

        $this->assertArrayNotHasKey('payout_details', $transferDetailsV1Data);
        $this->assertEquals($paymentMethod->getToken(), $transferDetailsV1Data['payment_method']['token']);

        $this->assertEquals($customer->getAccountNumber(), $transferDetailsV1Data['customer']['account_number']);
        $this->assertEquals($recipient->getBik(), $transferDetailsV1Data['recipient']['bik']);
        $this->assertEquals($purpose, $transferDetailsV1Data['purpose']);
        $this->assertEquals($amount->getAmount(), $transferDetailsV1Data['amount']['amount']);
    }
}
