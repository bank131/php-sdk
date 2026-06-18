<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Confirm\ConfirmInformation;
use Bank131\SDK\API\Request\Confirm\NominalPaymentParticipant;
use Bank131\SDK\API\Request\Confirm\TransferDetails;
use Bank131\SDK\API\Request\Fps\FpsVerificationRequest;
use Bank131\SDK\API\Request\Session\ChargebackPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\CreateSessionRequest;
use Bank131\SDK\API\Request\Session\InitPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\API\Request\Session\InitPayoutSessionWithFiscalizationRequest;
use Bank131\SDK\API\Request\Session\RefundPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\StartPaymentSessionRequest;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequest;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequestWithFiscalization;
use Bank131\SDK\Client;
use Bank131\SDK\DTO\AcquiringPayment;
use Bank131\SDK\DTO\AcquiringPaymentRefund;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\FiscalizationService;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\PaymentDetails;
use Bank131\SDK\DTO\PaymentMethod\FasterPaymentSystemPaymentMethod;
use Bank131\SDK\DTO\PaymentMethod\RecurrentPaymentMethod;
use Bank131\SDK\DTO\Payout;
use DateTimeImmutable;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

class FpsApiTest extends AbstractApiTest
{
    public function testInitPaymentSession(): void
    {
        $expectedResponseBody = [
            'status' => $status = 'ok',
            'session' => [
                'id' => $sessionId = 'ps_3230',
                'status' => $sessionStatus = 'in_progress',
                'created_at' => $sessionCreatedAt = '2022-03-01T11:57:31.652396Z',
                'updated_at' => $sessionUpdatedAt = '2022-03-01T11:57:31.861329Z',
                'payout_list' => [
                    [
                        'id' => $payoutId = 'po_31668',
                        'status' => $payoutStatus = 'in_progress',
                        'created_at' => $payoutCreatedAt = '2022-03-01T11:57:31.895773Z',
                        'payout_details' => [
                            'type' => $payoutDetailsType = 'bank_account',
                            'bank_account' => [
                                'system_type' => $systemType = 'faster_payment_system_verification',
                                'faster_payment_system_verification' => [
                                    'phone' => $phone = '79261234567',
                                    'bank_id' => $bankId = '100000000069',
                                ],
                            ],
                        ],
                        'participant_details' => [
                            'recipient' => [
                                'first_name' => $firstName = 'Ivan',
                                'last_name' => $lastName = 'Ivanov',
                                'middle_name' => $middleName = 'Ivanovich',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $client = $this->createClientWithMockResponse([
            new Response(200, [], json_encode($expectedResponseBody))
        ]);

        $verificationResponse = $client->fps()->verification(
            $this->createMock(FpsVerificationRequest::class)
        );

        $this->assertEquals($status, $verificationResponse->getStatus());

        $this->assertNotNull($session = $verificationResponse->getSession());

        $this->assertEquals($sessionId, $session->getId());
        $this->assertEquals($sessionStatus, $session->getStatus());
        $this->assertEquals(new DateTimeImmutable($sessionCreatedAt), $session->getCreatedAt());
        $this->assertEquals(new DateTimeImmutable($sessionUpdatedAt), $session->getUpdatedAt());

        $this->assertIsIterable($session->getPayoutList());
        $this->assertCount(1, $session->getPayoutList());
    }
}
