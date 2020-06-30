<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Middleware;

use Bank131\SDK\Services\Middleware\LogRequestsMiddleware;
use Bank131\SDK\Tests\Stub\InMemoryLogger;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class LogRequestMiddlewareTest extends TestCase
{
    public function testResponseWithoutException(): void
    {
        $mock = new MockHandler([new Response(), new Response(200, [], '{"parameter" : "value"}')]);
        $handlerStack = HandlerStack::create($mock);

        $handlerStack->push(
            new LogRequestsMiddleware(
                $logger = new InMemoryLogger()
            )
        );

        $container = [];
        $history = Middleware::history($container);
        $handlerStack->push($history);

        $client = new Client(['handler' => $handlerStack]);

        $client->post('http://any.url/path');
        $client->post('http://any.url/other/path');

        $log = $logger->getLog();

        for ($i = 0; $i < count($log); $i += 2) {
            $this->assertEquals(
                $t1 = substr($log[$i][0],19, 9),
                $t2 = substr($log[$i+1][0], 23, 9)
            );
        }

        $this->assertTrue(true);
    }
}