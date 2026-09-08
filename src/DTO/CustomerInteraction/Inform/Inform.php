<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction\Inform;

class Inform
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var QRInform|null
     */
    private $qr;

    /**
     * @var Notification|null
     */
    private $notification;

    public function getType(): string
    {
        return $this->type;
    }

    public function getQr(): ?QRInform
    {
        return $this->qr;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }
}
