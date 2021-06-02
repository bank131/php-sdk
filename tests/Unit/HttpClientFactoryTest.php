<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit;

use Bank131\SDK\Config;
use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\HttpClientFactory;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class HttpClientFactoryTest extends TestCase
{
    /**
     * @var JsonSerializer
     */
    private $serializer;

    /**
     * @var NullLogger
     */
    private $logger;

    /**
     * @var Config
     */
    private $config;

    public function setUp(): void
    {
        $this->serializer = new JsonSerializer();
        $this->logger     = new NullLogger();
        $this->config     = new Config(
            'https://test.uri',
            'x-test-project',
            file_get_contents(__DIR__ . '/../Fixtures/keys/private.pem')
        );
    }

    public function testSuccessfulCreate(): void
    {
        $middlewares = ['test_middleware' => static function (): void {}];

        $client = HttpClientFactory::create($this->serializer, $this->logger, $middlewares, $this->config);

        $httpClientConfig = $client->getConfig();

        $this->assertEquals($httpClientConfig['base_uri'], $this->config->getUri());
        $this->assertEquals($httpClientConfig['timeout'], $this->config->getTimeout());
        $this->assertEquals($httpClientConfig['connect_timeout'], $this->config->getConnectTimeout());
    }

    public function testUnsuccessfulCreate(): void
    {
        $middlewares = ['test_middleware' => 'not_callable'];

        $this->expectException(InvalidArgumentException::class);
        HttpClientFactory::create($this->serializer, $this->logger, $middlewares, $this->config);
    }
}
