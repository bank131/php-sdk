<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Token;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\DTO\Enum\TokenInfoTypeEnum;
use Bank131\SDK\DTO\PaymentMethod\CardPaymentMethod;

class TokenInfoRequest extends AbstractRequest
{
    /**
     * @see TokenInfoTypeEnum
     * @var string
     */
    private $type;

    /**
     * @var CardPaymentMethod|null
     */
    private $card;

    public function __construct(CardPaymentMethod $content)
    {
        $this->type = TokenInfoTypeEnum::CARD;
        $this->card = $content;
    }
}
