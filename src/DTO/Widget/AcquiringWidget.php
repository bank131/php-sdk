<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Widget;

use Bank131\SDK\Exception\InvalidArgumentException;

class AcquiringWidget
{
    /**
     * @var string
     */
    private $session_id;

    /**
     * @var string|null
     */
    private $success_return_url;

    /**
     * @var string|null
     */
    private $failure_return_url;

    /**
     * AcquiringWidget constructor.
     *
     * @param string $sessionId
     */
    public function __construct(string $sessionId)
    {
        $this->session_id = $sessionId;
    }

    /**
     * @param string $successReturnUrl
     */
    public function setSuccessReturnUrl(string $successReturnUrl): void
    {
        if (filter_var($successReturnUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('Success return url parameter must be a valid url');
        }

        $this->success_return_url = $successReturnUrl;
    }

    /**
     * @param string $failureReturnUrl
     */
    public function setFailureReturnUrl(string $failureReturnUrl): void
    {
        if (filter_var($failureReturnUrl, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('Failure return url parameter must be a valid url');
        }

        $this->failure_return_url = $failureReturnUrl;
    }
}