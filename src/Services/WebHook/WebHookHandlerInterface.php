<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook;

use Bank131\SDK\Services\WebHook\Hook\AbstractWebHook;

interface WebHookHandlerInterface
{
    public function handle(string $sign, string $body): AbstractWebHook;
}