<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook\Hook;

use Bank131\SDK\API\Request\Confirm\ConfirmInformation;

class ReadyToConfirm extends AbstractWebHook
{
    protected $type = WebHookTypeEnum::READY_TO_CONFIRM;

    /**
     * @var ConfirmInformation|null
     */
    private $confirm_information;

    public function getConfirmInformation(): ?ConfirmInformation
    {
        return $this->confirm_information;
    }
}