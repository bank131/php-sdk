<?php

declare(strict_types=1);

namespace Bank131\SDK\API\Request\Widget;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\DTO\Widget\AcquiringWidget;
use Bank131\SDK\DTO\Widget\SelfEmployedWidget;
use Bank131\SDK\DTO\Widget\TokenizeWidget;

class IssuePublicTokenRequest extends AbstractRequest
{
    /**
     * @var AcquiringWidget
     */
    private $acquiring_widget;

    /**
     * @var SelfEmployedWidget
     */
    private $self_employed_widget;

    /**
     * @var TokenizeWidget
     */
    private $tokenize_widget;

    /**
     * @param AcquiringWidget $acquiringWidget
     */
    public function setAcquiringWidget(AcquiringWidget $acquiringWidget): void
    {
        $this->acquiring_widget = $acquiringWidget;
    }

    /**
     * @param SelfEmployedWidget $selfEmployedWidget
     */
    public function setSelfEmployedWidget(SelfEmployedWidget $selfEmployedWidget): void
    {
        $this->self_employed_widget = $selfEmployedWidget;
    }

    /**
     * @param TokenizeWidget $tokenizeWidget
     */
    public function setTokenizeWidget(TokenizeWidget $tokenizeWidget): void
    {
        $this->tokenize_widget = $tokenizeWidget;
    }
}