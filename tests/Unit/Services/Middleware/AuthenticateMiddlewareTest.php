<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Middleware;

use Bank131\SDK\Services\Middleware\AuthenticateMiddleware;
use Bank131\SDK\Services\Security\SignatureGenerator;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AuthenticateMiddlewareTest extends TestCase
{
    public function testRequestIsAuthenticated(): void
    {
        $mock = new MockHandler([new Response(), new Response()]);
        $handlerStack = HandlerStack::create($mock);

        $signatureGeneratorMock = $this->createMock(SignatureGenerator::class);
        $signatureGeneratorMock->method('generate')->willReturn($signature = 'signature');

        $handlerStack->push(
            new AuthenticateMiddleware(
                $project = 'project-id',
                $signatureGeneratorMock
            )
        );

        $container = [];
        $history = Middleware::history($container);
        $handlerStack->push($history);

        $client = new Client(['handler' => $handlerStack]);

        $client->post('http://any.url');
        $client->post('http://any.url');

        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];

            $this->assertTrue($request->hasHeader(AuthenticateMiddleware::X_PARTNER_PROJECT_HEADER));
            $this->assertEquals([$project], $request->getHeader(AuthenticateMiddleware::X_PARTNER_PROJECT_HEADER));

            $this->assertTrue($request->hasHeader(AuthenticateMiddleware::X_PARTNER_SIGN_HEADER));
            $this->assertEquals([$signature], $request->getHeader(AuthenticateMiddleware::X_PARTNER_SIGN_HEADER));

            $this->assertFalse($request->hasHeader(AuthenticateMiddleware::X_PARTNER_SUBMERCHAT_HEADER));
        }

        $this->assertTrue(true);
    }

    public function testSubmerchantHeaderIsProvided(): void
    {
        $mock = new MockHandler([new Response(), new Response()]);
        $handlerStack = HandlerStack::create($mock);

        $signatureGeneratorMock = $this->createMock(SignatureGenerator::class);
        $signatureGeneratorMock->method('generate')->willReturn('signature');

        $handlerStack->push(
            new AuthenticateMiddleware(
                'project-id',
                $signatureGeneratorMock,
                $submerchant = 'test-submerchant'
            )
        );

        $container = [];
        $history = Middleware::history($container);
        $handlerStack->push($history);

        $client = new Client(['handler' => $handlerStack]);

        $client->post('http://any.url');
        $client->post('http://any.url');

        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];

            $this->assertTrue($request->hasHeader(AuthenticateMiddleware::X_PARTNER_SUBMERCHAT_HEADER));
            $this->assertEquals(
                [$submerchant],
                $request->getHeader(AuthenticateMiddleware::X_PARTNER_SUBMERCHAT_HEADER)
            );
        }
    }
}