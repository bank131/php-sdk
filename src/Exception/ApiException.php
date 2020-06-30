<?php

declare(strict_types=1);

namespace Bank131\SDK\Exception;

use Throwable;

class ApiException extends Bank131Exception
{
    public const DEFAULT_EXCEPTION_CODE = 'api_exception';

    /**
     * @var string
     */
    private $exceptionCode;

    /**
     * ApiException constructor.
     *
     * @param string         $exceptionCode
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $exceptionCode, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->exceptionCode = $exceptionCode;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getApiCode(): string
    {
        return $this->exceptionCode;
    }
}