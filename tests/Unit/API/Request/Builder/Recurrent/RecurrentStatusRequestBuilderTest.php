<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Recurrent;

use Bank131\SDK\API\Request\Builder\Recurrent\RecurrentStatusRequestBuilder;
use Bank131\SDK\API\Request\Recurrent\RecurrentStatusRequest;

class RecurrentStatusRequestBuilderTest extends AbstractRecurrentRequestBuilderTest
{
    public function testBuildSuccess()
    {
        $this->builder->setRecurrentToken('asdfasdfs');
        $result = $this->builder->build();
        $this->assertInstanceOf(RecurrentStatusRequest::class, $result);
    }

    protected function setUp(): void
    {
        $this->builder = new RecurrentStatusRequestBuilder();
    }
}
