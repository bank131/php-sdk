<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction\Inform;

class Notification
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var SberPayWidget|null
     */
    private $sber_pay_widget;

    public function getType(): string
    {
        return $this->type;
    }

    public function getSberPayWidget(): ?SberPayWidget
    {
        return $this->sber_pay_widget;
    }
}
