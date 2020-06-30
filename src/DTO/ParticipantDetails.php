<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class ParticipantDetails
{
    /**
     * @var Participant|null
     */
    private $sender;

    /**
     * @var Participant|null
     */
    private $recipient;

    /**
     * @return Participant|null
     */
    public function getSender(): ?Participant
    {
        return $this->sender;
    }

    /**
     * @return Participant|null
     */
    public function getRecipient(): ?Participant
    {
        return $this->recipient;
    }

    /**
     * @param Participant $sender
     */
    public function setSender(Participant $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @param Participant $recipient
     */
    public function setRecipient(Participant $recipient): void
    {
        $this->recipient = $recipient;
    }
}