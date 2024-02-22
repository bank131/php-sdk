<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction\Inform;

class Inform
{
    /**
     * @var QRInform|null
     */
    private $qr;

    /**
     * @return QRInform|null
     */
    public function getQr(): ?QRInform
    {
        return $this->qr;
    }
}
