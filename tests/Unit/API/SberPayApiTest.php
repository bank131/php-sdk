<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\API\Request\SberPay\SberPayPushRequest;
use GuzzleHttp\Psr7\Response;

class SberPayApiTest extends AbstractApiTest
{
    public function testSuccessfulSberPayPush(): void
    {
        $expectedResponseBody = [
            'status' => 'ok'
        ];

        $client = $this->createClientWithMockResponse([
            new Response(200, [], json_encode($expectedResponseBody))
        ]);

        $response = $client->sberPay()->sberPayPush(
            new SberPayPushRequest('89876543210', 'ps_123')
        );

        $this->assertSame('ok', $response->getStatus());
    }
}