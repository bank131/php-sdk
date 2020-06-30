<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction;

class CustomerInteractionContainer
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var Redirect|null
     */
    private $redirect;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return Redirect
     */
    public function getRedirect(): ?Redirect
    {
        return $this->redirect;
    }
}