<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Middleware;

use Bank131\SDK\Exception\ApiException;
use Bank131\SDK\Services\Middleware\ExceptionsHandlerMiddleware;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ExceptionHandlerMiddlewareTest extends TestCase
{
    /**
     * @dataProvider getResponsesProvider
     *
     * @param Response $response
     */
    public function testExceptionIsHandled(Response $response): void
    {
        $mock = new MockHandler([$response]);
        $handlerStack = HandlerStack::create($mock);

        $handlerStack->push(
            new ExceptionsHandlerMiddleware(
                new JsonSerializer()
            )
        );

        $container = [];
        $history = Middleware::history($container);
        $handlerStack->push($history);

        $client = new Client(['handler' => $handlerStack]);

        $this->expectException(ApiException::class);
        $this->expectExceptionCode($response->getStatusCode());

        $client->post('http://any.url');
    }

    /**
     * @return array
     */
    public function getResponsesProvider(): array
    {
        return [
            [new Response(400)],
            [new Response(400, [], 'body')],
            [new Response(400, [], '{}')],
            [
                new Response(
                    400,
                    [],
                    json_encode(
                        [
                            'status' => 'error',
                            'error' => [
                                'code' => 'test_code',
                                'description' => 'test_description'
                            ]
                        ]
                    )
                )
            ],
        ];
    }

    public function testResponseWithoutException(): void
    {
        $mock = new MockHandler([new Response($statusCode = 200, [], $body = 'body')]);
        $handlerStack = HandlerStack::create($mock);

        $handlerStack->push(
            new ExceptionsHandlerMiddleware(
                new JsonSerializer()
            )
        );

        $container = [];
        $history = Middleware::history($container);
        $handlerStack->push($history);

        $client = new Client(['handler' => $handlerStack]);

        $response =$client->post('http://any.url');

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals($body, (string)$response->getBody());
    }
}