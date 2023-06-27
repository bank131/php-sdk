<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Confirm;

class ExtendedTransferParticipant extends TransferParticipant
{
    /**
     * @var string|null
     */
    private $inn = null;

    /**
     * @var string|null
     */
    private $kpp = null;

    public function __construct(
        string  $accountNumber,
        string  $name,
        string  $bankName,
        string  $bik,
        string  $correspondentAccountNumber,
        ?string $inn,
        ?string $kpp
    ) {
        parent::__construct($accountNumber, $name, $bankName, $bik, $correspondentAccountNumber);
        $this->inn = $inn;
        $this->kpp = $kpp;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function getKpp(): ?string
    {
        return $this->kpp;
    }
}
