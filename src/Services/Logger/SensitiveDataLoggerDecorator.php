<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Logger;

use Bank131\SDK\Exception\InvalidArgumentException;
use Psr\Log\LoggerInterface;

class SensitiveDataLoggerDecorator implements LoggerInterface
{
    private const MASK = '***';

    private const SENSITIVE_DATA = [
        'number',
        'expiration_month',
        'expiration_year',
        'security_code'
    ];

    /**
     * @var LoggerInterface
     */
    private $decoratedLogger;

    /**
     * @param string $name
     * @param mixed  $arguments
     *
     * @return mixed
     */
    public function __call(string $name, $arguments)
    {
        if(!method_exists($this->decoratedLogger, $name)) {
            throw new InvalidArgumentException(
                sprintf('The %s::%s method does not exist', get_class($this->decoratedLogger), $name)
            );
        }

        return $this->decoratedLogger->{$name}($arguments);
    }

    /**
     * SensitiveDataLogger constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->decoratedLogger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->emergency($message);
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->alert($message);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->critical($message);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->error($message);
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->warning($message);
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->notice($message);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->info($message);
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->debug($message);
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = []): void
    {
        $message = $this->appendHttpBodyToMessage(
            $message,
            $context
        );

        $this->decoratedLogger->log($level, $message);
    }

    /**
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedArrayOffset
     *
     * @param iterable $context
     *
     * @return array
     */
    private function replaceSensitiveData(iterable $context): array
    {
        $result = [];

        foreach ($context as $key => $value) {
            if (is_array($value)) {
                $value = $this->replaceSensitiveData($value);
            }

            if (in_array($key, self::SENSITIVE_DATA, true)) {
                $value = self::MASK;
            }

            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    private function appendHttpBodyToMessage(string $message, array $context): string
    {
        $newMessage = $message;

        if (isset($context['http-body']) && is_iterable($context['http-body'])) {
            $maskedHttpBody = json_encode($this->replaceSensitiveData($context['http-body']));
            $newMessage = sprintf('%s HttpBody: `%s`.', $newMessage, $maskedHttpBody);
        }

        return $newMessage;
    }
}