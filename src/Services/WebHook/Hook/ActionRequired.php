<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook\Hook;

class ActionRequired extends AbstractWebHook
{
    protected $type = WebHookTypeEnum::ACTION_REQUIRED;
}