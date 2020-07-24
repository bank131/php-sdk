<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API;

use Bank131\SDK\API\Request\Recurrent\DisableRecurrentRequest;
use Bank131\SDK\API\Request\Recurrent\RecurrentStatusRequest;
use DateTimeImmutable;
use GuzzleHttp\Psr7\Response;

class RecurrentApiTest extends AbstractApiTest
{
    public function testGetStatus()
    {
        $expectedResponseBody = [
            'status'      => $status = 'ok',
            'created_at'  => $createdAt = '2020-07-07T07:11:27.499907Z',
            'finished_at' => $finishedAt = '2020-07-08T07:11:27.499907Z',
            'is_active'   => $isActive = true,
        ];

        $client = $this->createClientWithMockResponse(
            [
                new Response(200, [], json_encode($expectedResponseBody)),
            ]
        );

        $sessionResponse = $client->recurrent()->getStatus($this->createMock(RecurrentStatusRequest::class));
        $this->assertEquals(new DateTimeImmutable($finishedAt), $sessionResponse->getFinishedAt());
        $this->assertEquals(new DateTimeImmutable($createdAt), $sessionResponse->getCreatedAt());
        $this->assertSame($isActive, $sessionResponse->getIsActive());
        $this->assertSame($status, $sessionResponse->getStatus());
    }

    public function testDisable()
    {
        $expectedResponseBody = [
            'status'      => $status = 'ok',
            'created_at'  => $createdAt = '2020-07-08T07:11:27.499907Z',
            'finished_at' => $finishedAt = '2020-07-09T07:11:27.499907Z',
            'is_active'   => $isActive = false,
        ];

        $client = $this->createClientWithMockResponse(
            [
                new Response(200, [], json_encode($expectedResponseBody)),
            ]
        );

        $sessionResponse = $client->recurrent()->disable($this->createMock(DisableRecurrentRequest::class));
        $this->assertEquals(new DateTimeImmutable($finishedAt), $sessionResponse->getFinishedAt());
        $this->assertEquals(new DateTimeImmutable($createdAt), $sessionResponse->getCreatedAt());
        $this->assertSame($isActive, $sessionResponse->getIsActive());
        $this->assertSame($status, $sessionResponse->getStatus());
    }
}
