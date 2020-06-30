<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook\Hook;

class PaymentFinished extends AbstractWebHook
{
    protected $type = WebHookTypeEnum::PAYMENT_FINISHED;
}