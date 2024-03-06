<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Confirm;

class TransferParticipant
{
    /**
     * @var string
     */
    private $account_number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $bank_name;

    /**
     * @var string
     */
    private $bik;

    /**
     * @var string
     */
    private $correspondent_account_number;

    public function __construct(
        string $accountNumber,
        string $name,
        string $bankName,
        string $bik,
        string $correspondentAccountNumber
    ) {
        $this->account_number               = $accountNumber;
        $this->name                         = $name;
        $this->bank_name                    = $bankName;
        $this->bik                          = $bik;
        $this->correspondent_account_number = $correspondentAccountNumber;
    }

    public function getAccountNumber(): string
    {
        return $this->account_number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBankName(): string
    {
        return $this->bank_name;
    }

    public function getBik(): string
    {
        return $this->bik;
    }

    public function getCorrespondentAccountNumber(): string
    {
        return $this->correspondent_account_number;
    }
}
