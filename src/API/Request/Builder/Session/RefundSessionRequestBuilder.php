<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Builder\AbstractBuilder;
use Bank131\SDK\API\Request\Session\RefundPaymentSessionRequest;
use Bank131\SDK\DTO\Amount;

final class RefundSessionRequestBuilder extends AbstractBuilder
{
    /**
     * @var Amount|null
     */
    protected $amount;

    /**
     * @var mixed
     */
    protected $metadata;

    /**
     * @var string
     */
    private $sessionId;

    /**
     * RefundSessionRequestBuilder constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @param int    $value
     * @param string $currency
     *
     * @return $this
     */
    public function setAmount(int $value, string $currency): self
    {
        $this->amount = new Amount($value, $currency);

        return $this;
    }

    /**
     * @param mixed $metadata
     *
     * @return $this
     */
    public function setMetadata($metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return RefundPaymentSessionRequest
     */
    public function build(): AbstractRequest
    {
        $request = new RefundPaymentSessionRequest($this->sessionId);

        if ($this->amount) {
            $request->setAmount($this->amount);
        }

        if ($this->metadata) {
            $request->setMetadata($this->metadata);
        }

        return $request;
    }
}
