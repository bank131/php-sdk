<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Confirm;

class ConfirmInformation
{
    /**
     * @var TransferDetails|null
     */
    private $transfer_details = null;

    /**
     * @var AccountTransferDetails|null
     */
    private $account_details = null;

    /**
     * @var ConfirmExchange[]|null
     */
    private $exchanges = null;

    /**
     * @param ConfirmExchange[]|null $exchanges
     */
    public function __construct(
        ?TransferDetails        $transferDetails,
        ?array                  $exchanges,
        ?AccountTransferDetails $accountDetails
    ) {
        $this->transfer_details = $transferDetails;
        $this->exchanges        = $exchanges;
        $this->account_details  = $accountDetails;
    }

    public function getTransferDetails(): ?TransferDetails
    {
        return $this->transfer_details;
    }

    public function getAccountDetails(): ?AccountTransferDetails
    {
        return $this->account_details;
    }

    public function getExchanges(): ?array
    {
        return $this->exchanges;
    }
}
