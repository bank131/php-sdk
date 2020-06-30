<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\WebHook\Hook;

use Bank131\SDK\Helper\BaseEnum;

class WebHookTypeEnum extends BaseEnum
{
    public const ACTION_REQUIRED = 'action_required';

    public const READY_TO_CAPTURE = 'ready_to_capture';

    public const READY_TO_CONFIRM = 'ready_to_confirm';

    public const PAYMENT_FINISHED = 'payment_finished';

    public const PAYMENT_REFUNDED = 'payment_refunded';
}