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
        $intendedResponseBody = [
            'status'    => $status = 'ok',
            'recurrent' =>
                [
                    'created_at'  => $createdAt = '2020-07-07T07:11:27.499907Z',
                    'finished_at' => $finishedAt = '2020-07-08T07:11:27.499907Z',
                    'is_active'   => $isActive = true,
                ],
        ];

        $client = $this->createClientWithMockResponse(
            [
                new Response(200, [], json_encode($intendedResponseBody)),
            ]
        );

        $statusResponse   = $client->recurrent()->getStatus($this->createMock(RecurrentStatusRequest::class));
        $recurrentDetails = $statusResponse->getRecurrent();
        $this->assertEquals(new DateTimeImmutable($finishedAt), $recurrentDetails->getFinishedAt());
        $this->assertEquals(new DateTimeImmutable($createdAt), $recurrentDetails->getCreatedAt());
        $this->assertSame($isActive, $recurrentDetails->getIsActive());
        $this->assertSame($status, $statusResponse->getStatus());
    }

    public function testDisable()
    {
        $intendedResponseBody = [
            'status'    => $status = 'ok',
            'recurrent' => [
                'created_at'  => $createdAt = '2020-07-08T07:11:27.499907Z',
                'finished_at' => $finishedAt = '2020-07-09T07:11:27.499907Z',
                'is_active'   => $isActive = false,
            ],
        ];

        $client = $this->createClientWithMockResponse(
            [
                new Response(200, [], json_encode($intendedResponseBody)),
            ]
        );

        $disableResponse  = $client->recurrent()->disable($this->createMock(DisableRecurrentRequest::class));
        $recurrentDetails = $disableResponse->getRecurrent();

        $this->assertEquals(new DateTimeImmutable($finishedAt), $recurrentDetails->getFinishedAt());
        $this->assertEquals(new DateTimeImmutable($createdAt), $recurrentDetails->getCreatedAt());
        $this->assertSame($isActive, $recurrentDetails->getIsActive());
        $this->assertSame($status, $disableResponse->getStatus());
    }
}
