<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction;

use Bank131\SDK\DTO\CustomerInteraction\Inform\Inform;

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
     * @var Inform|null
     */
    private $inform;

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

    /**
     * @return Inform|null
     */
    public function getInform(): ?Inform
    {
        return $this->inform;
    }
}
