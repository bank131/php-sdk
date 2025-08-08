<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\Exception\ApiException;
use Bank131\SDK\Exception\IdempotencyKeyAlreadyExistsException;
use GuzzleHttp\Psr7\Response;

class ExceptionApiTest extends AbstractApiTest
{
    public function testExceptionsHandled(): void
    {
        $expectedResponse = [
            'error' => [
                'code' => 'api_exception_code',
                'description' => 'description here'
            ]
        ];

        $client = $this->createClientWithMockResponse([
            new Response(400, [], json_encode($expectedResponse))
        ]);

        $sessionRequest = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->build();

        $this->expectException(ApiException::class);
        $client->session()->create($sessionRequest);
    }

    public function testExceptionHasApiCode(): void
    {
        $expectedResponse = [
            'error' => [
                'code' => $exceptionCode = 'api_exception_code',
                'description' => 'description here'
            ]
        ];

        $client = $this->createClientWithMockResponse([
            new Response(400, [], json_encode($expectedResponse))
        ]);

        $sessionRequest = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->build();

        try {
            $client->session()->create($sessionRequest);
        } catch (ApiException $exception) {
            $this->assertEquals($exceptionCode, $exception->getApiCode());
        }
    }

    public function testIdempotencyKeyAlreadyExistException(): void
    {
        $expectedResponse = [
            'error' => [
                'code' => $exceptionCode = 'idempotency_key_already_exists',
                'description' => 'already in progress or processed'
            ]
        ];

        $client = $this->createClientWithMockResponse([
            new Response(400, [], json_encode($expectedResponse))
        ]);

        $sessionRequest = RequestBuilderFactory::create()
            ->createPaymentSession()
            ->build();

        try {
            $client->session()->create($sessionRequest);
        } catch (IdempotencyKeyAlreadyExistsException $exception) {
            $this->assertEquals($exceptionCode, $exception->getApiCode());
        }
    }
}