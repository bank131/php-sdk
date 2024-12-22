<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Session;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\DTO\Collection\PayoutRequestCollection;
use Bank131\SDK\DTO\Collection\PaymentRequestCollection;

class InitMultiSessionRequest extends AbstractRequest
{
    /**
     * @var PaymentRequestCollection
     */
    private $payment_list;

    /**
     * @var PayoutRequestCollection
     */
    private $payout_list;

    public function __construct(PaymentRequestCollection $payment_list, PayoutRequestCollection $payout_list)
    {
        $this->payment_list = $payment_list;
        $this->payout_list = $payout_list;
    }
}
