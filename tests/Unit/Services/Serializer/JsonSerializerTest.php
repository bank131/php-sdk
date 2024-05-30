<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Serializer;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\API\Request\Wallet\WalletBalanceRequest;
use Bank131\SDK\API\Response\Session\SessionResponse;
use Bank131\SDK\DTO\AcquiringPayment;
use Bank131\SDK\DTO\Card\EncryptedCard;
use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

class JsonSerializerTest extends TestCase
{
    /**
     * @var JsonSerializer
     */
    protected $serializer;

    protected function setUp(): void
    {
        $this->serializer = new JsonSerializer();
    }

    public function testDeserializeInvalidJsonString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->serializer->deserialize('invalid json string', 'classname');
    }

    public function testSerializeObject(): void
    {
        $session = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->setAmount(1000, 'rub')
            ->setCard(
                new EncryptedCard(
                    'number_hash',
                    'expiration_date_hash',
                    'security_code_hash',
                    'cardholder_name_hash'
                )
            )
            ->build();

        $jsonString = $this->serializer->serialize($session);

        $expected = [
            'amount_details'  => [
                'amount'   => 1000,
                'currency' => 'rub',
            ],
            'payment_details' => [
                'type' => 'card',
                'card' => [
                    'type'           => 'encrypted_card',
                    'encrypted_card' => [
                        'number_hash'          => 'number_hash',
                        'expiration_date_hash' => 'expiration_date_hash',
                        'security_code_hash'   => 'security_code_hash',
                        'cardholder_name_hash' => 'cardholder_name_hash',
                    ],
                ],
            ],
        ];

        $this->assertEquals(json_encode($expected), $jsonString);
    }

    public function testSerializeNestedArray(): void
    {
        $object = new class {
            /**
             * @var array
             */
            private $collection;

            public function __construct()
            {
                $this->collection = [];

                $this->collection[]['test'] = new class {

                    /**
                     * @var string
                     */
                    private $property = 'string';

                    /**
                     * @return mixed
                     */
                    public function getProperty()
                    {
                        return $this->property;
                    }
                };
            }

            /**
             * @return array
             */
            public function getCollection(): array
            {
                return $this->collection;
            }
        };

        $jsonString = $this->serializer->serialize($object);

        $this->assertEquals('{"collection":[{"test":{"property":"string"}}]}', $jsonString);
    }

    public function testSerializeAssociativeArray(): void
    {
        $object = new class {
            /**
             * @var mixed
             */
            public $collection;

            /**
             * @return mixed
             */
            public function getCollection()
            {
                return $this->collection;
            }
        };

        $object->collection = ['sadfsdf' => 'erwgbxv', 1 => 'dfsafd', '5' => true];
        $jsonString         = $this->serializer->serialize($object);

        $this->assertEquals(
        /** @lang JSON */ '{"collection":{"sadfsdf":"erwgbxv","1":"dfsafd","5":true}}',
            $jsonString
        );
    }

    public function testDeserializeMixedProperty(): void
    {
        $normalizedObject = [
            'case1' => 'a12345',
            'case2' => true,
            'case3' => ['a12345', 12345, 12345.12, true, null],
            'case4' => ['asdfasdf' => 'a12345', 2 => 12345, 12345.12, 'sdfasfcbv34r' => true, '5' => null],
        ];

        $jsonString = json_encode($normalizedObject);

        /** @var SessionResponse $result */
        $result = $this->serializer->deserialize(
            $jsonString,
            get_class(
                new class {
                    /**
                     * @return mixed
                     */
                    public function getCase1()
                    {
                        return $this->case1;
                    }

                    /**
                     * @return mixed
                     */
                    public function getCase2()
                    {
                        return $this->case2;
                    }

                    /**
                     * @return mixed
                     */
                    public function getCase3()
                    {
                        return $this->case3;
                    }

                    /**
                     * @return mixed
                     */
                    public function getCase4()
                    {
                        return $this->case4;
                    }

                    private $case1;

                    private $case2;

                    private $case3;

                    private $case4;
                }
            )
        );

        foreach ((new ReflectionObject($result))->getProperties() as $property) {
            $property->setAccessible(true);
            $this->assertSame($normalizedObject[$property->getName()], $property->getValue($result));
        }
    }

    public function testSerializeObjectWithDateTime(): void
    {
        $object = new WalletBalanceRequest(
            new DateTimeImmutable('2019-10-14T19:53:00+03:00')
        );

        $jsonString = $this->serializer->serialize($object);

        $expected = [
            'request_datetime' => '2019-10-14T19:53:00+03:00',
        ];
        $this->assertEquals(json_encode($expected), $jsonString);

    }

    public function testDeserializeObject(): void
    {
        $normalizedObject = [
            'status'  => $responseStatus = 'ok',
            'session' => [
                'id'                 => $sessionId = 'test_ps_1',
                'status'             => $sessionStatus = 'in_progress',
                'created_at'         => $sessionCreatedAt = '2020-05-29T07:01:37.499907Z',
                'updated_at'         => $sessionUpdatedAt = '2020-05-29T07:01:37.499907Z',
                'acquiring_payments' => [
                    [
                        'id'              => $paymentId = 'test_pm_1',
                        'status'          => $paymentStatus = 'in_progress',
                        'created_at'      => $paymentCreatedAt = '2020-05-29T07:01:37.499907Z',
                        'customer'        => [
                            'reference' => $customerReference = 'lucky',
                        ],
                        'payment_details' => [
                            'type' => $paymentDetailsType = 'card',
                            'card' => [
                                'brand' => $cardBrand = 'visa',
                                'last4' => $cardLastFour = '4242',
                            ],
                        ],
                        'amount_details'  => [
                            'amount'   => $amountValue = 10000,
                            'currency' => $amountCurrency = 'rub',
                        ],
                        'amounts'         => [
                            'gross' => [
                                'amount'   => $amountValue = 10000,
                                'currency' => $amountCurrency = 'rub',
                            ],
                            'net'   => [
                                'amount'   => $amountValue = 10000,
                                'currency' => $amountCurrency = 'rub',
                            ],
                            'fee' => [
                                'merchant_fee' => [
                                    'amount' => 100,
                                    'currency' => 'rub',
                                ]
                            ],
                        ],
                        'metadata'        => $metadata = '{"key":"value"}',
                        'payment_options' => [
                            'return_url' => $returnUrl = 'http=>//bank131.ru',
                        ],
                    ],
                ],
            ],
        ];

        $jsonString = json_encode($normalizedObject);

        /** @var SessionResponse $result */
        $result = $this->serializer->deserialize($jsonString, SessionResponse::class);

        $this->assertEquals($responseStatus, $result->getStatus());

        $this->assertNotNull($session = $result->getSession());

        $this->assertEquals($sessionId, $session->getId());
        $this->assertEquals($sessionStatus, $session->getStatus());
        $this->assertEquals(new DateTimeImmutable($sessionCreatedAt), $session->getCreatedAt());
        $this->assertEquals(new DateTimeImmutable($sessionUpdatedAt), $session->getUpdatedAt());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()[0];

        $this->assertEquals($paymentId, $acquiringPayment->getId());
        $this->assertEquals(new DateTimeImmutable($paymentCreatedAt), $acquiringPayment->getCreatedAt());
        $this->assertEquals($paymentStatus, $acquiringPayment->getStatus());
        $this->assertEquals($customerReference, $acquiringPayment->getCustomer()->getReference());
        $this->assertEquals($amountValue, $acquiringPayment->getAmountDetails()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmountDetails()->getCurrency());
        $this->assertEquals($amountValue, $acquiringPayment->getAmounts()->getGross()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmounts()->getGross()->getCurrency());
        $this->assertEquals($amountValue, $acquiringPayment->getAmounts()->getNet()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmounts()->getNet()->getCurrency());
        $this->assertEquals(100, $acquiringPayment->getAmounts()->getFee()->getMerchantFee()->getAmount());
        $this->assertEquals('rub', $acquiringPayment->getAmounts()->getFee()->getMerchantFee()->getCurrency());
        $this->assertEquals($metadata, $acquiringPayment->getMetadata());
        $this->assertEquals($returnUrl, $acquiringPayment->getPaymentOptions()->getReturnUrl());
    }


    public function testDeserializeObjectSberPay(): void
    {

        $normalizedObject = [
            'status'  => $responseStatus = 'ok',
            'session' => [
                'id'                 => $sessionId = 'test_ps_1',
                'status'             => $sessionStatus = 'in_progress',
                'created_at'         => $sessionCreatedAt = '2020-05-29T07:01:37.499907Z',
                'updated_at'         => $sessionUpdatedAt = '2020-05-29T07:01:37.499907Z',
                'acquiring_payments' => [
                    [
                        'id'              => $paymentId = 'test_pm_1',
                        'status'          => $paymentStatus = 'in_progress',
                        'created_at'      => $paymentCreatedAt = '2020-05-29T07:01:37.499907Z',
                        'customer'        => [
                            'reference' => $customerReference = 'lucky',
                        ],
                        'payment_details' => [
                            'type' => $paymentDetailsType = 'internet_banking',
                            'internet_banking'=>[
                                'type'=> $internetBankingType = 'sber_pay',
                                'sber_pay' => [
                                    'channel' => $channel = 'app',
                                    'phone' => $phone = '79313255172',
                                ],
                            ]
                        ],
                        'amount_details'  => [
                            'amount'   => $amountValue = 10000,
                            'currency' => $amountCurrency = 'rub',
                        ],
                        'amounts'         => [
                            'gross' => [
                                'amount'   => $amountValue = 10000,
                                'currency' => $amountCurrency = 'rub',
                            ],
                            'net'   => [
                                'amount'   => $amountValue = 10000,
                                'currency' => $amountCurrency = 'rub',
                            ],
                        ],
                        'metadata'        => $metadata = '{"key":"value"}',
                        'payment_options' => [
                            'return_url' => $returnUrl = 'http=>//bank131.ru',
                        ],
                    ],
                ],
            ],
        ];

        $jsonString = json_encode($normalizedObject);

        /** @var SessionResponse $result */
        $result = $this->serializer->deserialize($jsonString, SessionResponse::class);

        $this->assertEquals($responseStatus, $result->getStatus());

        $this->assertNotNull($session = $result->getSession());

        $this->assertEquals($sessionId, $session->getId());
        $this->assertEquals($sessionStatus, $session->getStatus());
        $this->assertEquals(new DateTimeImmutable($sessionCreatedAt), $session->getCreatedAt());
        $this->assertEquals(new DateTimeImmutable($sessionUpdatedAt), $session->getUpdatedAt());

        $this->assertIsIterable($session->getAcquiringPayments());
        $this->assertCount(1, $session->getAcquiringPayments());

        /** @var AcquiringPayment $acquiringPayment */
        $acquiringPayment = $session->getAcquiringPayments()[0];

        $this->assertEquals($paymentId, $acquiringPayment->getId());
        $this->assertEquals($paymentDetailsType, $acquiringPayment->getPaymentDetails()->getType());
        $this->assertEquals($channel, $acquiringPayment->getPaymentDetails()->getInternetBanking()->getSberPay()->getChannel());
        $this->assertEquals($phone, $acquiringPayment->getPaymentDetails()->getInternetBanking()->getSberPay()->getPhone());
        $this->assertEquals(new DateTimeImmutable($paymentCreatedAt), $acquiringPayment->getCreatedAt());
        $this->assertEquals($paymentStatus, $acquiringPayment->getStatus());
        $this->assertEquals($customerReference, $acquiringPayment->getCustomer()->getReference());
        $this->assertEquals($amountValue, $acquiringPayment->getAmountDetails()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmountDetails()->getCurrency());
        $this->assertEquals($amountValue, $acquiringPayment->getAmounts()->getGross()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmounts()->getGross()->getCurrency());
        $this->assertEquals($amountValue, $acquiringPayment->getAmounts()->getNet()->getAmount());
        $this->assertEquals($amountCurrency, $acquiringPayment->getAmounts()->getNet()->getCurrency());
        $this->assertEquals($metadata, $acquiringPayment->getMetadata());
        $this->assertEquals($returnUrl, $acquiringPayment->getPaymentOptions()->getReturnUrl());
    }
}
