<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Serializer;

interface SerializerInterface
{
    /**
     * Serializes an object to a json string.
     *
     * @param object $object
     *
     * @return string
     */
    public function serialize(object $object): string;

    /**
     * Deserializes a json string to an object of the given type.
     *
     * @param string       $string
     * @param class-string $type
     *
     * @return object
     */
    public function deserialize(string $string, string $type): object;
}