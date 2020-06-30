<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\Exception\InvalidArgumentException;

class PaymentOptions
{
    /**
     * @var string|null
     */
    private $return_url;

    /**
     * @var bool|null
     */
    private $save_payment_details;

    /**
     * @param string $returnUrl
     */
    public function setReturnUrl(string $returnUrl): void
    {
        if (filter_var($returnUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('Return url parameter must be a valid url');
        }

        $this->return_url = $returnUrl;
    }

    /**
     * @return string|null
     */
    public function getReturnUrl(): ?string
    {
        return $this->return_url;
    }

    public function savePaymentDetails(): void
    {
        $this->save_payment_details = true;
    }

    /**
     * @return bool
     */
    public function isPaymentDetailsSaved(): bool
    {
        return $this->save_payment_details === true;
    }
}