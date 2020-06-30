<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\DTO\Collection;

use Bank131\SDK\DTO\Collection\AbstractCollection;
use Bank131\SDK\Exception\InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\TestCase;

abstract class AbstractCollectionTest extends TestCase
{
    /**
     * @param array $elements
     *
     * @return AbstractCollection
     */
    abstract protected function createCollection(array $elements = []): AbstractCollection;

    public function testAccessToCollectionAsArray(): void
    {
        $elements = $this->createArrayOfMockElements($count = 10);

        $collection = $this->createCollection($elements);

        $this->assertEquals($count, count($collection), 'Count after creation');

        $collection[$key = 'test'] = $this->createMockElement();

        $this->assertEquals($count + 1 , count($collection), 'Count after adding an element');

        foreach ($collection as $key => $element) {
            $this->assertSame($collection[$key], $element);
            $this->assertInstanceOf($collection->getType(), $element);
        }

        unset($collection[$key]);

        $this->assertFalse(isset($collection[$key]));
        $this->assertEquals($count, count($collection));
    }

    public function testAddedWrongElementToArray(): void
    {
        $collection = $this->createCollection();

        $this->expectException(InvalidArgumentException::class);
        $collection[] = 'wrong_element';
    }

    public function testArrayMap(): void
    {
        $elements = $this->createArrayOfMockElements(10);

        $collection = $this->createCollection($elements);

        $map = array_map(
            function ($element) {
                return $element;
            },
            $collection->iteratorToArray()
        );

        $this->assertSame($elements, $map);
    }

    public function testIsCollectionEmpty(): void
    {
        $collection = $this->createCollection();

        $this->assertTrue($collection->isEmpty());

        $collection[] = $this->createMockElement();

        $this->assertFalse($collection->isEmpty());
    }

    public function testGetNonExistingElement(): void
    {
        $collection = $this->createCollection();

        $collection[] = $this->createMockElement();

        $this->expectException(InvalidArgumentException::class);
        $collection->get(1);

    }

    /**
     * @param int $count
     *
     * @return array
     */
    protected function createArrayOfMockElements(int $count): array
    {
        $elements = [];

        for ($i = 0; $i < $count; $i++) {
            $elements[] = $this->createMockElement();
        }

        return $elements;
    }

    /**
     * @return mixed|MockClass
     */
    protected function createMockElement()
    {
        $collection = $this->createCollection();

        return $this->createMock($collection->getType());
    }
}