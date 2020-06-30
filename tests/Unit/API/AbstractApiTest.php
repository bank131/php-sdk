<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\Client;
use Bank131\SDK\Config;
use Bank131\SDK\Services\Middleware\ExceptionsHandlerMiddleware;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

abstract class AbstractApiTest extends TestCase
{
    /**
     * @param array $responses
     *
     * @return Client
     */
    protected function createClientWithMockResponse(array $responses): Client
    {
        $mockHandler = new MockHandler($responses);

        $handlerStack = HandlerStack::create($mockHandler);
        $handlerStack->push(new ExceptionsHandlerMiddleware(new JsonSerializer()));

        $httpClient = new HttpClient(['handler' => $handlerStack]);


        $client = new Client(
            $this->createMock(Config::class), $httpClient
        );

        return $client;
    }
}