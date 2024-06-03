<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction;

class Inform
{
    /**
     * @var QrInform|null
     */
    private $qr;

    /**
     * @return QrInform|null
     */
    public function getQr(): ?QrInform
    {
        return $this->qr;
    }
}
