<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Confirm;

use Bank131\SDK\DTO\Amount;

class ConfirmExchange
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Amount
     */
    private $source;

    /**
     * @var Amount
     */
    private $destination;

    /**
     * @var string|null
     */
    private $fx_rate = null;

    /**
     * @var Amount|null
     */
    private $commission = null;

    public function __construct(
        string  $id,
        Amount  $source,
        Amount  $destination,
        ?string $fxRate = null,
        ?Amount $commission = null
    ) {
        $this->id          = $id;
        $this->source      = $source;
        $this->destination = $destination;
        $this->fx_rate     = $fxRate;
        $this->commission  = $commission;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSource(): Amount
    {
        return $this->source;
    }

    public function getDestination(): Amount
    {
        return $this->destination;
    }

    public function getFxRate(): ?string
    {
        return $this->fx_rate;
    }

    public function getCommission(): ?Amount
    {
        return $this->commission;
    }
}
