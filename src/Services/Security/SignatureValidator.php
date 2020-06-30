<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Security;

use Bank131\SDK\Exception\InvalidSignatureException;
use Bank131\SDK\Exception\InvalidArgumentException;

class SignatureValidator
{
    /**
     * @var resource
     */
    private $publicKeyPointer;

    /**
     * SignatureValidator constructor.
     *
     * @param string $publicKey
     */
    public function __construct(string $publicKey)
    {
        $publicKeyPointer  = openssl_pkey_get_public($publicKey);

        if ($publicKeyPointer === false) {
            throw new InvalidArgumentException('Wrong public key format');
        }

        $this->publicKeyPointer = $publicKeyPointer;
    }

    /**
     * @param string $signature
     * @param string $data
     *
     * @throws InvalidSignatureException
     */
    public function validate(string $signature, string $data): void
    {
        $decodedSignature = base64_decode($signature);

        $result = openssl_verify($data, $decodedSignature, $this->publicKeyPointer, OPENSSL_ALGO_SHA256);

        if ($result !== 1) {
            throw new InvalidSignatureException('Invalid signature');
        }
    }
}