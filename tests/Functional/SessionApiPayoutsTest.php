<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Functional;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\API\Request\Session\InitPayoutSessionRequest;
use Bank131\SDK\Client;
use Bank131\SDK\Config;
use Bank131\SDK\DTO\BankAccount\BankAccountRu;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\Payout;
use Bank131\SDK\DTO\Wallet\QiwiWallet;
use PHPUnit\Framework\TestCase;

class SessionApiPayoutsTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp(): void
    {
        $config = new Config(
            'http://playground.bank131.ru:8081',
            'sdk-payout',
            file_get_contents(__DIR__ . '/../Fixtures/keys/private.pem')
        );
        $this->client = new Client($config);
    }

    public function testCreateSession(): void
    {
        $sessionRequest = RequestBuilderFactory::create()
            ->createPayoutSession()
            ->build();

        $sessionResponse = $this->client->session()->create($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());

        $this->assertNotNull($session = $sessionResponse->getSession());

        $this->assertNotNull($session->getId());
        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull($session->getUpdatedAt());
        $this->assertTrue($session->isCreated());
    }

    public function testStartPayoutSession(): void
    {
        //1-st step: CREATE SESSION
        $sessionRequest = RequestBuilderFactory::create()
            ->createPayoutSession()
            ->build();

        $sessionCreateResponse = $this->client->session()->create($sessionRequest);

        $this->assertTrue($sessionCreateResponse->isOk());
        $this->assertNotNull($session = $sessionCreateResponse->getSession());

        $metadata = ['key' => 'value'];

        //2-nd step: START SESSION
        $sessionRequest = RequestBuilderFactory::create()
            ->startPayoutSession($session->getId())
            ->setCard(new BankCard($bankCardNumber = '4242424242424242'))
            ->setRecipient(
                $this->createParticipantWithFullName(
                    $recipientFullName = 'FullName'
                )
            )
            ->setAmount($amountValue = 10000, $amountCurrency = 'rub')
            ->setCustomer(new Customer($reference = 'lucky'))
            ->setMetadata(json_encode($metadata))
            ->build();

        $sessionStartResponse = $this->client->session()->startPayout($sessionRequest);

        $this->assertTrue($sessionStartResponse->isOk());
        $this->assertNotNull($session = $sessionStartResponse->getSession());

        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull($session->getUpdatedAt());
        $this->assertGreaterThan($session->getCreatedAt(), $session->getUpdatedAt());
        $this->assertTrue($session->isInProgress());

        $this->assertIsIterable($session->getPayments());
        $this->assertCount(1, $session->getPayments());

        /** @var Payout $payout */
        $payout = $session->getPayments()[0];

        $this->assertNotNull($payout->getId());
        $this->assertNotNull($payout->getStatus());
        $this->assertNotNull($payout->getCreatedAt());
        $this->assertNotNull($payout->getCustomer());
        $this->assertEquals($reference, $payout->getCustomer()->getReference());
        $this->assertEquals($amountValue, $payout->getAmountDetails()->getAmount());
        $this->assertEquals($amountCurrency, $payout->getAmountDetails()->getCurrency());
        $this->assertEquals(json_encode($metadata), $payout->getMetadata());
    }

    /**
     * @dataProvider getInitPayoutSessionProvider
     *
     * @param InitPayoutSessionRequest $sessionRequest
     */
    public function testInitPayoutSession(InitPayoutSessionRequest $sessionRequest): void
    {
        $sessionResponse = $this->client->session()->initPayout($sessionRequest);

        $this->assertTrue($sessionResponse->isOk());
        $this->assertNotNull($session = $sessionResponse->getSession());

        $this->assertNotNull($session->getId());
        $this->assertNotNull($session->getCreatedAt());
        $this->assertNotNull( $session->getUpdatedAt());
        $this->assertTrue($session->isInProgress());

        $this->assertIsIterable($session->getPayments());
        $this->assertCount(1, $session->getPayments());

        /** @var Payout $payout */
        $payout = $session->getPayments()->get(0);

        $this->assertEquals('in_progress', $payout->getStatus());
        $this->assertNotNull($payout->getId());
        $this->assertNotNull($payout->getCreatedAt());
        $this->assertNotNull($payout->getPaymentMethod());
        $this->assertNotNull($payout->getCustomer()->getReference());
        $this->assertNotNull($payout->getAmountDetails()->getAmount());
        $this->assertNotNull($payout->getAmountDetails()->getCurrency());
        $this->assertNotNull($payout->getMetadata());
        $this->assertNotNull($payout->getParticipantDetails()->getRecipient()->getFullName());
    }

    /**
     * @return array
     */
    public function getInitPayoutSessionProvider(): array
    {
        return [
            [
                RequestBuilderFactory::create()
                ->initPayoutSession()
                ->setCard(new BankCard('4242424242424242'))
                ->setRecipient(
                    $this->createParticipantWithFullName('John Doe')
                )
                ->setAmount(1000, 'rub')
                ->setCustomer(new Customer('lucky'))
                ->setMetadata(json_encode(['key' => 'value']))
                ->build()
            ],
            [
                RequestBuilderFactory::create()
                    ->initPayoutSession()
                    ->setWallet(new QiwiWallet('9111111111'))
                    ->setRecipient(
                        $this->createParticipantWithFullName('John Doe')
                    )
                    ->setAmount(1000, 'rub')
                    ->setCustomer(new Customer('lucky'))
                    ->setMetadata(json_encode(['key' => 'value']))
                    ->build()
            ],
            [
                RequestBuilderFactory::create()
                    ->initPayoutSession()
                    ->setBankAccount(
                        new BankAccountRu(
                            '123456789',
                            '12345678901234567890',
                            'John Doe',
                            'Description'
                        )
                    )
                    ->setRecipient(
                        $this->createParticipantWithFullName('John Doe')
                    )
                    ->setAmount(1000, 'rub')
                    ->setCustomer(new Customer('lucky'))
                    ->setMetadata(json_encode(['key' => 'value']))
                    ->build()
            ]
        ];
    }

    /**
     * @param string $fullName
     *
     * @return Participant
     */
    private function createParticipantWithFullName(string $fullName): Participant
    {
        $participant = new Participant();
        $participant->setFullName($fullName);

        return $participant;
    }
}