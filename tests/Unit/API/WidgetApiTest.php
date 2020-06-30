<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\API\Request\Widget\IssuePublicTokenRequest;
use Bank131\SDK\API\Response\Enum\ResponseStatusEnum;
use GuzzleHttp\Psr7\Response;

class WidgetApiTest extends AbstractApiTest
{
    public function testIssuePublicToken(): void
    {
        $expectedResponseBody = [
            'status' => ResponseStatusEnum::OK,
            'public_token' => $publicToken = 'public_token'
        ];

        $client = $this->createClientWithMockResponse([
            new Response(200, [], json_encode($expectedResponseBody))
        ]);

        $publicTokenResponse = $client->widget()->issuePublicToken(
            $this->createMock(IssuePublicTokenRequest::class)
        );

        $this->assertTrue($publicTokenResponse->isOk());

        $this->assertEquals($publicToken, $publicTokenResponse->getPublicToken());
    }
}