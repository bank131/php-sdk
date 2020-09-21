<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Widget;

use Bank131\SDK\API\Request\Builder\Widget\IssuePublicTokenBuilder;
use Bank131\SDK\API\Request\Widget\IssuePublicTokenRequest;
use Bank131\SDK\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IssuePublicTokenBuilderTest extends TestCase
{
    /**
     * @var IssuePublicTokenBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new IssuePublicTokenBuilder();
    }

    public function testFailedBuildEmptySession(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder->build();
    }

    public function testSuccessBuildFullSession(): void
    {
        $request = $this->builder
            ->setAcquiringWidget(
                'test_ps_id',
                'http://success.url',
                'http://failed.url',
                false
            )
            ->setSelfEmployedWidget('123456789012')
            ->setTokenizeWidget()
            ->build();
        $this->assertInstanceOf(IssuePublicTokenRequest::class, $request);
    }
}