<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session;

use Bank131\SDK\API\Request\Builder\Session\RefundSessionRequestBuilder;
use Bank131\SDK\API\Request\Session\RefundPaymentSessionRequest;
use PHPUnit\Framework\TestCase;

class RefundSessionRequestBuilderTest extends TestCase
{
    /**
     * @var RefundSessionRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new RefundSessionRequestBuilder('test_ps_id');
    }

    public function testSuccessBuildEmptySession(): void
    {
        $request = $this->builder->build();
        $this->assertInstanceOf(RefundPaymentSessionRequest::class, $request);
    }
}
