<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\Card;

class TokenizedCard extends AbstractCard
{
    /**
     * @var string
     */
    private $token;

    /**
     * TokenizedCard constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return CardEnum::TOKENIZED_CARD;
    }
}
