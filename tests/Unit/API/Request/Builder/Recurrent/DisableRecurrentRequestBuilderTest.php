<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Recurrent;

use Bank131\SDK\API\Request\Builder\Recurrent\DisableRecurrentRequestBuilder;
use Bank131\SDK\API\Request\Recurrent\DisableRecurrentRequest;

class DisableRecurrentRequestBuilderTest extends AbstractRecurrentRequestBuilderTest
{
    public function testBuildSuccess()
    {
        $this->builder->setRecurrentToken('1234adsfasdf13413');
        $result = $this->builder->build();
        $this->assertInstanceOf(DisableRecurrentRequest::class, $result);
    }

    protected function setUp(): void
    {
        $this->builder = new DisableRecurrentRequestBuilder();
    }
}
