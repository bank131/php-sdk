<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook;

use Bank131\SDK\Services\Security\SignatureValidator;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use Bank131\SDK\Services\Serializer\SerializerInterface;

abstract class WebHookHandlerFactory
{
    public static function create(string $publicKey, SerializerInterface $serializer = null): WebHookHandler
    {
        $webHookHandler = new WebHookHandler(
            new SignatureValidator($publicKey),
            $serializer ?? new JsonSerializer()
        );

        return $webHookHandler;
    }
}