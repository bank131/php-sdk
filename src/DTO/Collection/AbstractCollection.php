<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use ArrayAccess;
use Bank131\SDK\Exception\InvalidArgumentException;
use Countable;
use Iterator;
use JsonSerializable;

abstract class AbstractCollection implements Countable, ArrayAccess, Iterator, JsonSerializable
{
    /**
     * Contains all collection elements.
     *
     * @var array
     */
    protected $elements;

    /**
     * Current number of element.
     *
     * @var int
     */
    private $count;

    /**
     * Key of the current element.
     *
     * @var int
     */
    private $current;

    /**
     * This method should return a class name of an element that collection contains.
     *
     * @return class-string
     */
    abstract public function getType(): string;

    /**
     * AbstractCollection constructor.
     *
     * @psalm-suppress MixedAssignment
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->count    = 0;
        $this->current  = 0;
        $this->elements = [];

        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    /**
     * @return array
     */
    public function iteratorToArray(): array
    {
        return iterator_to_array($this);
    }

    /**
     * @param int|string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if (!isset($this->elements[$key])) {
            throw new InvalidArgumentException('There is no element with key: ' . $key);
        };

        return $this->elements[$key];
    }

    /**
     * @internal
     *
     * @return mixed
     */
    public function current()
    {
        return $this->elements[$this->current];
    }

    /**
     * @internal
     */
    public function next(): void
    {
        ++$this->current;
    }

    /**
     * @internal
     *
     * @return int
     */
    public function key(): int
    {
        return $this->current;
    }

    /**
     * @internal
     *
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->elements[$this->current]);
    }

    /**
     * @internal
     */
    public function rewind(): void
    {
        $this->current = 0;
    }

    /**
     * @internal
     *
     * @param int|string $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->elements[$offset]);
    }

    /**
     * @internal
     *
     * @param int|string $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->elements[$offset] ?? null;
    }

    /**
     * @internal
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->addElement($value);
    }

    /**
     * @internal
     *
     * @param int|string $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->elements[$offset]);
        --$this->count;
    }

    /**
     * @internal
     *
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * Checks if the collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->count === 0;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->elements;
    }

    /**
     * Adds an element to the collection.
     *
     * @param mixed $element
     */
    protected function addElement($element): void
    {
        $type = $this->getType();

        if (!$element instanceof $type) {
            throw new InvalidArgumentException(
                sprintf('Value must be an instance of %s', $this->getType())
            );
        }

        $this->elements[] = $element;
        $this->count++;
    }
}