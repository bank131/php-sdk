<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Security;

use Bank131\SDK\Exception\InvalidArgumentException;

class SignatureGenerator
{
    /**
     * @var resource
     */
    private $privateKeyPointer;

    /**
     * SignatureGenerator constructor.
     *
     * @param string $privateKey Can be a string having the format file://path/to/file.pem
     *                           or a PEM formatted private key.
     * @param string $passphrase The optional parameter must be used if the private key
     *                           is protected by a passphrase
     */
    public function __construct(string $privateKey, string $passphrase = '')
    {
        $privateKeyPointer = openssl_pkey_get_private($privateKey, $passphrase);

        if (!$privateKeyPointer) {
            throw new InvalidArgumentException('Wrong private key');
        }
        $this->privateKeyPointer = $privateKeyPointer;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function generate(string $data): string
    {
        openssl_sign($data, $signature, $this->privateKeyPointer, OPENSSL_ALGO_SHA256);

        $encodedSignature = base64_encode($signature);

        return $encodedSignature;
    }
}