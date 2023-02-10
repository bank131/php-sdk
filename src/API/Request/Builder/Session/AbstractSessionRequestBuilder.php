<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Session;

use Bank131\SDK\API\Request\Builder\AbstractBuilder;
use Bank131\SDK\DTO\Amount;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\Participant;
use Bank131\SDK\DTO\ParticipantDetails;
use Bank131\SDK\DTO\TransactionSplit\TransactionSplitInfo;

abstract class AbstractSessionRequestBuilder extends AbstractBuilder
{
    /**
     * @var Amount|null
     */
    protected $amount;

    /**
     * @var Customer|null
     */
    protected $customer;

    /**
     * @var ParticipantDetails|null
     */
    protected $participantDetails;

    /**
     * @var mixed
     */
    protected $metadata;

    /**
     * @var TransactionSplitInfo|null
     */
    protected $transactionSplitInfo;

    /**
     * @param int    $value
     * @param string $currency
     *
     * @return $this
     */
    public function setAmount(int $value, string $currency): self
    {
        $this->amount = new Amount($value, $currency);

        return $this;
    }

    /**
     * @param Customer $customer
     *
     * @return $this
     */
    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @param Participant $recipient
     *
     * @return $this
     */
    public function setRecipient(Participant $recipient): self
    {
        $participantDetails = $this->getParticipantDetails();

        $participantDetails->setRecipient($recipient);

        return $this;
    }

    /**
     * @param Participant $sender
     *
     * @return $this
     */
    public function setSender(Participant $sender): self
    {
        $participantDetails = $this->getParticipantDetails();

        $participantDetails->setSender($sender);

        return $this;
    }

    /**
     * @param mixed $metadata
     */
    public function setMetadata($metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return ParticipantDetails
     */
    protected function getParticipantDetails(): ParticipantDetails
    {
        if (!$this->participantDetails) {
            $this->participantDetails = new ParticipantDetails();
        }

        return $this->participantDetails;
    }

    public function setTransactionSplitInfo(TransactionSplitInfo $transactionSplitInfo): self
    {
        $this->transactionSplitInfo = $transactionSplitInfo;

        return $this;
    }
}
