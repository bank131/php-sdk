<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Session;

use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\DTO\PaymentMethod\FasterPaymentSystemPaymentMethod;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use PHPUnit\Framework\TestCase;

class InitPayoutSessionRequestTest extends TestCase
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
        $paymentDetails = new PaymentDetails(new FasterPaymentSystemPaymentMethod());
        $amount = new Amount(999, 'rub');
        $participant = new ParticipantDetails();
        $participant->setSender((function () {
            $p = new Participant();
            $p->setEmail('nonono@email.com');

            return $p;
        })());

        $request = new InitPayoutSessionRequest($paymentDetails, $amount, $participant);

        $requestData = json_decode($this->serializer->serialize($request), true);

        $this->assertArrayNotHasKey('payment_method', $requestData);
        $this->assertEquals(PaymentMethodEnum::FASTER_PAYMENT_SYSTEM, $requestData['payout_details']['type']);

        $v1Request = $request->createV1Version();

        $requestV1Data = json_decode($this->serializer->serialize($v1Request), true);

        $this->assertInstanceOf(InitPayoutSessionRequest::class, $v1Request);

        $this->assertArrayNotHasKey('payout_details', $requestV1Data);
        $this->assertEquals(PaymentMethodEnum::FASTER_PAYMENT_SYSTEM, $requestV1Data['payment_method']['type']);

        $this->assertEquals($amount->getAmount(), $requestV1Data['amount_details']['amount']);
        $this->assertEquals($participant->getSender()->getEmail(), $requestV1Data['participant_details']['sender']['email']);
    }
}
