<?php

namespace Bank131\SDK\Exception;

class IdempotencyKeyAlreadyExistsException extends ApiException
{
    public const IDEMPOTENCY_KEY_ALREADY_EXISTS_CODE = 'idempotency_key_already_exists';
}