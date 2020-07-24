<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Recurrent;

use Bank131\SDK\API\Request\Builder\Recurrent\RecurrentRequestBuilder;
use Bank131\SDK\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

abstract class AbstractRecurrentRequestBuilderTest extends TestCase
{
    /**
     * @var RecurrentRequestBuilder
     */
    protected $builder;

    public function testBuildValidationFailure()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->builder->build();
    }

}
