<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

class PhoneIdent extends AbstractInternetBanking
{
    /**
     * @var string $phone
     */
    private $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function getType(): string
    {
        return InternetBankingEnum::PHONE_IDENT;
    }
}