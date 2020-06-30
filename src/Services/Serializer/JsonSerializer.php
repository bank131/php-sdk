<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Serializer;

use Bank131\SDK\DTO\Collection\AbstractCollection;
use Bank131\SDK\Exception\InvalidArgumentException;
use DateTime;
use DateTimeInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

final class JsonSerializer implements SerializerInterface
{

    /**
     * @inheritDoc
     *
     * @throws ReflectionException
     */
    public function serialize(object $object): string
    {
        $normalizedObject = $this->normalize($object);

        $jsonString = json_encode($normalizedObject);

        return $jsonString;
    }

    /**
     * @inheritDoc
     */
    public function deserialize(string $string, string $className): object
    {
        if (!$this->isValidJson($string)) {
            throw new InvalidArgumentException('Invalid json string');
        }

        /** @var array<string, string|array> $normalized */
        $normalized = json_decode($string, true);

        $result = $this->denormalize($normalized, $className);

        return $result;
    }

    /**
     * Normalizes an object into an array contained other arrays or scalar values.
     *
     * @psalm-suppress MixedAssignment
     *
     * @param object $object
     *
     * @return array
     * @throws ReflectionException
     */
    private function normalize(object $object): array
    {
        $reflection = new ReflectionClass($object);

        $properties = $this->getAllPropertiesOfReflectionClass($reflection);

        $result = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);

            $value = $property->getValue($object);

            if ($value === null) {
                continue;
            }

            switch (true) {
                case is_scalar($value):
                    $normalized = $value;
                    break;
                case is_iterable($value):
                    if (count($value) < 1) {
                        continue 2;
                    }

                    $normalized = $this->normalizeIterable($value);
                    break;
                case $value instanceof DateTimeInterface:
                    $normalized = $value->format(DateTime::ATOM);
                    break;
                default:
                    $normalized = $this->normalize($value);
            }

            $result[$property->getName()] = $normalized;
        }

        return $result;
    }

    /**
     * Returns an array of ReflectionProperty objects of the given reflection class
     *
     * @param ReflectionClass $reflectionClass
     *
     * @return ReflectionProperty[]
     */
    private function getAllPropertiesOfReflectionClass(ReflectionClass $reflectionClass): array
    {
        $properties = $reflectionClass->getProperties();

        $parentClass = $reflectionClass->getParentClass();

        if ($parentClass) {
            $properties = array_merge($properties, $this->getAllPropertiesOfReflectionClass($parentClass));
        }

        return $properties;
    }

    /**
     * Checks if string is valid json string
     *
     * @param string $jsonString
     *
     * @return bool
     */
    private function isValidJson(string $jsonString): bool
    {
        json_decode($jsonString);

        return (json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * Denormalizes the given array back into an object of the given class;
     *
     * @psalm-suppress MixedAssignment
     *
     * @param array<string, string|array>  $array
     * @param class-string                 $className
     *
     * @return object
     * @throws ReflectionException
     */
    private function denormalize(array $array, string $className): object
    {
        $reflection = new ReflectionClass($className);
        $instance = $reflection->newInstanceWithoutConstructor();

        foreach ($array as $key => $value) {
            if ($reflection->hasProperty($key)) {
                $property = $reflection->getProperty($key);
                $property->setAccessible(true);

                $getterName = 'get' . str_replace('_', '', $property->getName());

                if ($reflection->hasMethod($getterName)) {

                    $typeReflection = $reflection->getMethod($getterName)->getReturnType();

                    /** @var class-string $typeName */
                    $typeName = (string) $typeReflection;

                    if ($typeReflection && !$typeReflection->isBuiltin()) {
                        /** @var array<string, string|array> $value */

                        $objectReflection = new ReflectionClass($typeName);

                        if ($objectReflection->isSubclassOf( DateTimeInterface::class)) {
                            $dateTimeInstance = $objectReflection->newInstance($value);
                            $property->setValue($instance, $dateTimeInstance);
                        } elseif ($objectReflection->isSubclassOf( AbstractCollection::class)) {
                            /** @var AbstractCollection $collectionInstance */
                            $collectionInstance = $objectReflection->newInstance();

                            /** @var array<string, string|array> $collectionElement */
                            foreach ($value as $collectionElement) {
                                $collectionInstance[] = $this->denormalize(
                                    $collectionElement,
                                    $collectionInstance->getType()
                                );
                            }
                            $property->setValue($instance, $collectionInstance);
                        } else {
                            $property->setValue($instance, $this->denormalize($value, $typeName));
                        }
                    } else {
                        settype($value, $typeName);
                        $property->setValue($instance, $value);
                    }
                }

            }
        }

        return $instance;
    }

    /**
     * @param iterable $iterable
     *
     * @return array
     * @throws ReflectionException
     */
    private function normalizeIterable(iterable $iterable): array
    {
        $entries = [];

        foreach ($iterable as $key => $entry) {
            switch (true) {
                case is_iterable($entry):
                    $entry = $this->normalizeIterable($entry);
                    break;
                case is_object($entry):
                    $entry = $this->normalize($entry);
                    break;
                default:
                    $entries[] = $entry;

            }
            $entries[$key] = $entry;
        }

        return $entries;
    }
}