<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook;

use Bank131\SDK\Exception\InternalException;
use Bank131\SDK\Exception\InvalidSignatureException;
use Bank131\SDK\Services\Security\SignatureValidator;
use Bank131\SDK\Services\Serializer\SerializerInterface;
use Bank131\SDK\Services\WebHook\Hook\AbstractWebHook;

class WebHookHandler implements WebHookHandlerInterface
{
    private const WEBHOOK_NAMESPACE = __NAMESPACE__ . '\Hook';

    /**
     * @var SignatureValidator
     */
    private $validator;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * WebHookHandler constructor.
     *
     * @param SignatureValidator  $validator
     * @param SerializerInterface $serializer
     */
    public function __construct(SignatureValidator $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * @param string $sign
     * @param string $body
     *
     * @return AbstractWebHook
     * @throws InvalidSignatureException
     */
    public function handle(string $sign, string $body): AbstractWebHook
    {
        $this->validator->validate($sign, $body);

        $webHookType = $this->resolveType($body);

        /** @var AbstractWebHook $hook */
        $hook = $this->serializer->deserialize($body, $webHookType);

        return $hook;
    }

    /**
     * @param string $body
     *
     * @return class-string
     */
    private function resolveType(string $body): string
    {
        /** @var array $normalized */
        $normalized = json_decode($body, true);

        /** @var class-string $type */
        $type = sprintf(
            "%s\%s",
            self::WEBHOOK_NAMESPACE,
            str_replace('_', '', ucwords((string)$normalized['type'], '_'))
        );

        if (!class_exists($type)) {
            throw new InternalException('The wrong webhook type was received');
        }

        return $type;
    }
}