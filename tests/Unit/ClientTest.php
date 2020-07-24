<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit;

use Bank131\SDK\API\RecurrentApi;
use Bank131\SDK\API\SessionApi;
use Bank131\SDK\API\WalletApi;
use Bank131\SDK\API\WidgetApi;
use Bank131\SDK\Client;
use Bank131\SDK\Config;
use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Services\Serializer\SerializerInterface;
use Bank131\SDK\Services\WebHook\Hook\ReadyToCapture;
use Bank131\SDK\Services\WebHook\WebHookHandler;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Config
     */
    private $config;

    protected function setUp(): void
    {
        $this->config = new Config(
            'http://test.uri',
            'x-test-project',
            file_get_contents(__DIR__ . '/../Fixtures/keys/private.pem')
        );
    }

    public function testCreateClientWithoutClient(): void
    {
        $client = new Client($this->config);
        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
    }

    public function testCreateClientWithoutSerializer(): void
    {
        $client = new Client($this->config);
        $this->assertInstanceOf(SerializerInterface::class, $client->getSerializer());
    }

    public function testHandleWebHookWithExplicitlySetWebhookHandler(): void
    {
        $webHookHandlerMock = $this->createMock(WebHookHandler::class);
        $webHookHandlerMock->method('handle')->willReturn(new ReadyToCapture());

        $client = new Client(
            $this->config,
            null,
            null,
            null,
            $webHookHandlerMock
        );

        $webHook = $client->handleWebHook('sign', 'body');
        $this->assertInstanceOf(ReadyToCapture::class, $webHook);
    }

    public function testHandleWebHookWithoutSetWebhookHandler(): void
    {
        $client = new Client($this->config);

        $this->expectException(InvalidArgumentException::class);
        $client->handleWebHook('sign', 'body');
    }

    public function testWidgetApi(): void
    {
        $client = new Client($this->config);

        $api = $client->widget();
        $this->assertInstanceOf(WidgetApi::class, $api);
    }

    public function testSessionApi(): void
    {
        $client = new Client($this->config);

        $api = $client->session();
        $this->assertInstanceOf(SessionApi::class, $api);
    }

    public function testWalletApi(): void
    {
        $client = new Client($this->config);

        $api = $client->wallet();
        $this->assertInstanceOf(WalletApi::class, $api);;
    }

    public function testRecurrentApi(): void
    {
        $client = new Client($this->config);

        $api = $client->recurrent();
        $this->assertInstanceOf(RecurrentApi::class, $api);
    }
}
