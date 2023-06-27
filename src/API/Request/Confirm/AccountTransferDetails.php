<?php
declare(strict_types=1);

namespace Bank131\SDK\API\Request\Confirm;

class AccountTransferDetails
{
    /**
     * @var ExtendedTransferParticipant
     */
    private $sender;

    /**
     * @var ExtendedTransferParticipant
     */
    private $recipient;

    public function __construct(
        ExtendedTransferParticipant $sender,
        ExtendedTransferParticipant $recipient
    ) {
        $this->sender    = $sender;
        $this->recipient = $recipient;
    }

    public function getSender(): ExtendedTransferParticipant
    {
        return $this->sender;
    }

    public function getRecipient(): ExtendedTransferParticipant
    {
        return $this->recipient;
    }
}
