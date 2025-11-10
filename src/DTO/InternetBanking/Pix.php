<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\InternetBanking;

final class Pix extends AbstractInternetBanking
{
    /**
     * @var string $document
     */
    private string $document;

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var string $email
     */
    private string $email;

    /**
     * @var ?string $phone
     */
    private ?string $phone;

    public function __construct(
        string $document,
        string $name,
        string $email,
        ?string $phone = null
    ) {
        $this->document = $document;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getType(): string
    {
        return InternetBankingEnum::PIX;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

}
