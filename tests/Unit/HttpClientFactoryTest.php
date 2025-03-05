<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit;

use Bank131\SDK\Config;
use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\HttpClientFactory;
use Bank131\SDK\Services\Middleware\AuthenticateMiddleware;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use ReflectionObject;

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

    public function testSuccessfulCreateWithSubmerchant(): void
    {
        $middlewares = ['test_middleware' => static function (): void {}];

        $client = HttpClientFactory::create(
            $this->serializer,
            $this->logger,
            $middlewares,
            new Config(
                'https://test.uri',
                'x-test-project',
                file_get_contents(__DIR__ . '/../Fixtures/keys/private.pem'),
                null,
                10,
                10,
                $submerchant = 'test-submerchant'
            )
        );

        $authMiddleware = $this->extractAuthMiddleware($client->getConfig());

        $this->assertNotNull($authMiddleware);

        $authMiddlewareReflection = new ReflectionObject($authMiddleware);
        $submerchantProperty = $authMiddlewareReflection->getProperty('submerchant');
        $submerchantProperty->setAccessible(true);

        $this->assertEquals($submerchant, $submerchantProperty->getValue($authMiddleware));
    }

    public function testSuccessfulCreateAndSubmerchantDoesNotProvided(): void
    {
        $middlewares = ['test_middleware' => static function (): void {}];

        $client = HttpClientFactory::create($this->serializer, $this->logger, $middlewares, $this->config);

        $authMiddleware = $this->extractAuthMiddleware($client->getConfig());

        $this->assertNotNull($authMiddleware);

        $authMiddlewareReflection = new ReflectionObject($authMiddleware);
        $submerchantProperty = $authMiddlewareReflection->getProperty('submerchant');
        $submerchantProperty->setAccessible(true);

        $this->assertNull($submerchantProperty->getValue($authMiddleware));
    }

    private function extractAuthMiddleware(array $httpClientConfig): ?AuthenticateMiddleware
    {
        $handler = new ReflectionObject($httpClientConfig['handler']);
        $stack = $handler->getProperty('stack');
        $stack->setAccessible(true);
        $middlewareList = $stack->getValue($httpClientConfig['handler']);

        foreach ($middlewareList as $middleware) {
            if ($middleware[1] === AuthenticateMiddleware::class) {
                return $middleware[0];
            }
        }

        return null;
    }
}
