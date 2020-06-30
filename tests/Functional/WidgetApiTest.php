<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Functional;

use Bank131\SDK\API\Request\Builder\RequestBuilderFactory;
use Bank131\SDK\Client;
use Bank131\SDK\Config;
use PHPUnit\Framework\TestCase;

class WidgetApiTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp(): void
    {
        $config = new Config(
            'http://playground.bank131.ru:8081',
            'shop-andreev',
            file_get_contents(__DIR__ . '/../Fixtures/keys/private.pem')
        );
        $this->client = new Client($config);
    }

    public function testIssuePublicToken(): void
    {
        $request = RequestBuilderFactory::create()
            ->issuePublicTokenBuilder()
            ->setTokenizeWidget()
            ->setSelfEmployedWidget('111111111111')
            ->build();

        $publicTokenResponse = $this->client->widget()->issuePublicToken($request);

        $this->assertTrue($publicTokenResponse->isOk());
        $this->assertNotNull($publicTokenResponse->getPublicToken());
    }
}