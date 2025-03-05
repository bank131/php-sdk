<?php

declare(strict_types=1);

namespace Bank131\SDK;

use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Services\Middleware\AuthenticateMiddleware;
use Bank131\SDK\Services\Middleware\ExceptionsHandlerMiddleware;
use Bank131\SDK\Services\Middleware\LogRequestsMiddleware;
use Bank131\SDK\Services\Security\SignatureGenerator;
use Bank131\SDK\Services\Serializer\SerializerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

abstract class HttpClientFactory
{
    /**
     * @param SerializerInterface  $serializer
     * @param LoggerInterface|null $logger
     * @param iterable<callable>   $middlewares
     * @param Config|null          $config
     *
     * @return ClientInterface
     */
    public static function create(
        SerializerInterface $serializer,
        ?LoggerInterface $logger = null,
        iterable $middlewares = [],
        Config $config = null
    ): ClientInterface {
        $stack = HandlerStack::create();

        $stack->remove('http_errors');

        $stack->push(new ExceptionsHandlerMiddleware($serializer), ExceptionsHandlerMiddleware::class);
        $stack->push(new LogRequestsMiddleware($logger ?? new NullLogger()), LogRequestsMiddleware::class);

        foreach ($middlewares as $key => $middleware) {
            if (!is_callable($middleware)) {
                throw new InvalidArgumentException('Http Client middleware should be callable.');
            }

            $stack->push($middleware, is_string($key) ? $key : '');
        }

        $httpClientConfig = [
            'headers'  => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-SDK-VERSION' => Version::getVersion(),
            ],
            'handler' => $stack
        ];

        if ($config !== null) {
            $stack->push(
                new AuthenticateMiddleware(
                    $config->getProjectId(),
                    new SignatureGenerator($config->getPrivateKey()),
                    $config->getSubmerchant()
                ),
                AuthenticateMiddleware::class
            );

            $httpClientConfig['base_uri']         = $config->getUri();
            $httpClientConfig['timeout']          = $config->getTimeout();
            $httpClientConfig['connect_timeout']  = $config->getConnectTimeout();
        }

        $client = new Client($httpClientConfig);

        return $client;
    }
}
