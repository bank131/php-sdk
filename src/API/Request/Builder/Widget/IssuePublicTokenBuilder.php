<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Builder\Widget;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\Builder\AbstractBuilder;
use Bank131\SDK\API\Request\Widget\IssuePublicTokenRequest;
use Bank131\SDK\DTO\Widget\AcquiringWidget;
use Bank131\SDK\DTO\Widget\SelfEmployedWidget;
use Bank131\SDK\DTO\Widget\TokenizeWidget;
use Bank131\SDK\Exception\InvalidArgumentException;

class IssuePublicTokenBuilder extends AbstractBuilder
{
    /**
     * @var AcquiringWidget|null
     */
    private $acquiringWidget;

    /**
     * @var SelfEmployedWidget|null
     */
    private $selfEmployedWidget;

    /**
     * @var TokenizeWidget|null
     */
    private $tokenizeWidget;

    /**
     * @return IssuePublicTokenRequest
     */
    public function build(): AbstractRequest
    {
        $this->validate();

        $request = new IssuePublicTokenRequest();

        if ($this->acquiringWidget) {
            $request->setAcquiringWidget($this->acquiringWidget);
        }

        if ($this->selfEmployedWidget) {
            $request->setSelfEmployedWidget($this->selfEmployedWidget);
        }

        if ($this->tokenizeWidget) {
            $request->setTokenizeWidget($this->tokenizeWidget);
        }

        return $request;
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function validate(): void
    {
        if (!array_filter(get_object_vars($this))) {
            throw new InvalidArgumentException('You must specify at least one widget object');
        }
    }

    /**
     * @param string      $sessionId
     * @param string|null $failedReturnUrl
     * @param string|null $successReturnUrl
     *
     * @return $this
     */
    public function setAcquiringWidget(
        string $sessionId,
        ?string $successReturnUrl = null,
        ?string $failedReturnUrl = null
    ): self {
        $acquiringWidget = new AcquiringWidget($sessionId);

        if ($successReturnUrl) {
            $acquiringWidget->setSuccessReturnUrl($successReturnUrl);
        }

        if ($failedReturnUrl) {
            $acquiringWidget->setFailureReturnUrl($failedReturnUrl);
        }

        $this->acquiringWidget = $acquiringWidget;

        return $this;
    }

    /**
     * @param string $taxReference
     *
     * @return $this
     */
    public function setSelfEmployedWidget(string $taxReference): self
    {
        $this->selfEmployedWidget = new SelfEmployedWidget($taxReference);

        return $this;
    }

    /**
     * @return $this
     */
    public function setTokenizeWidget(): self
    {
        $this->tokenizeWidget = new TokenizeWidget();

        return $this;
    }
}