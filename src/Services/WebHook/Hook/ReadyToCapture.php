<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook\Hook;

class ReadyToCapture extends AbstractWebHook
{
    protected $type = WebHookTypeEnum::READY_TO_CAPTURE;
}