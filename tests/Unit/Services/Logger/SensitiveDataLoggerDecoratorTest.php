<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Logger;

use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Services\Logger\SensitiveDataLoggerDecorator;
use Bank131\SDK\Tests\Stub\InMemoryLogger;
use PHPUnit\Framework\TestCase;

class SensitiveDataLoggerDecoratorTest extends TestCase
{
    private const MESSAGE_TEXT = 'Message.';
    /**
     * @var SensitiveDataLoggerDecorator
     */
    private $logger;

    protected function setUp(): void
    {
        $this->logger = new SensitiveDataLoggerDecorator(new InMemoryLogger());
    }

    public function testCallToUndefinedMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->logger->undefinedMethod();
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array  $sensitiveData
     * @param string $expectedMessage
     */
    public function testLogSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->log('level', self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testEmergencySensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->emergency(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testAlertSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->alert(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testCriticalSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->critical(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testErrorSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->error(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testWarningSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->warning(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testNoticeSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->notice(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testInfoSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->info(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    /**
     * @dataProvider getSensitiveDataProvider
     *
     * @param array $sensitiveData
     * @param string $expectedMessage
     */
    public function testDebugSensitiveDataIsReplaced(array $sensitiveData, string $expectedMessage): void
    {
        $this->logger->debug(self::MESSAGE_TEXT, $sensitiveData);

        $log = $this->logger->getLog();

        $this->assertEquals($expectedMessage, $log[0][0]);
        $this->assertEmpty($log[0][1]);
    }

    public function getSensitiveDataProvider(): array
    {
        return [
            [
                [
                    'http-body' => [
                        'payment_details'=> [
                            'type'=> 'card',
                            'card'=> [
                                'number'=> '4242424242424242',
                                'expiration_month' => '12',
                                'expiration_year' => '22',
                                'security_code' => '123'
                            ]
                        ]
                    ]
                ],
                sprintf('%s HttpBody: `%s`.',
                    self::MESSAGE_TEXT,
                    json_encode(
                        [
                            'payment_details' => [
                                'type'=> 'card',
                                'card'=> [
                                    'number'=> '***',
                                    'expiration_month' => '***',
                                    'expiration_year' => '***',
                                    'security_code' => '***'
                                ]
                            ]
                        ]
                    )
                )
            ],
            [
                [
                    'http-body' => [
                        'amount_details'=> [
                            'amount'=> 10000,
                            'currency'=> 'rub'
                        ],
                        'metadata'=> [
                            'key' => 'value'
                        ]
                    ]
                ],
                sprintf('%s HttpBody: `%s`.',
                    self::MESSAGE_TEXT,
                    json_encode(
                        [
                            'amount_details'=> [
                                'amount'=> 10000,
                                'currency'=> 'rub'
                            ],
                            'metadata'=> [
                                'key' => 'value'
                            ],
                        ]
                    )
                )
            ]
        ];
    }
}