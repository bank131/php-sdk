<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\WebHookService;

use Bank131\SDK\Exception\InternalException;
use Bank131\SDK\Services\Security\SignatureValidator;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use Bank131\SDK\Services\WebHook\Hook\WebHookTypeEnum;
use Bank131\SDK\Services\WebHook\WebHookHandler;
use PHPUnit\Framework\TestCase;

class WebHookHandlerTest extends TestCase
{
    /**
     * @var WebHookHandler
     */
    private $webHookHandler;

    protected function setUp(): void
    {
        $this->webHookHandler = new WebHookHandler(
            $this->createMock(SignatureValidator::class),
            new JsonSerializer()
        );
    }

    /**
     * @dataProvider getWebhookHandledSuccessfullyProvider
     *
     * @param string $body
     * @param string $type
     */
    public function testWebhookHandledSuccessfully(string $body, string $type): void
    {
        $hook = $this->webHookHandler->handle('sign', $body);

        $this->assertEquals($hook->getType(), $type);
        $this->assertNotNull($hook->getSession());
    }

    public function testUnknownWebhookType(): void
    {
        $this->expectException(InternalException::class);
        $this->webHookHandler->handle(
            'sign',
            json_encode(
                [
                    'type' => 'unknown_webhook_type',
                ]
            )
        );
    }

    public function getWebhookHandledSuccessfullyProvider(): array
    {
        $session = [
            'id' => 'test_ps_1',
            'status' => 'created',
            'created_at' => '2020-05-29T07:01:37.499907Z',
            'updated_at' => '2020-05-29T07:01:37.499907Z'
        ];

        $cases = [];

        foreach (WebHookTypeEnum::all() as $case) {
            $cases[] = [
                json_encode(
                    [
                        'type' => $case,
                        'session' => $session
                    ]
                ),
                $case
            ];
        }

        return $cases;
    }

}