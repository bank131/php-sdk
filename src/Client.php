<?php

declare(strict_types=1);

namespace Bank131\SDK;

use Bank131\SDK\API\SessionApi;
use Bank131\SDK\API\WalletApi;
use Bank131\SDK\API\WidgetApi;
use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Services\Logger\SensitiveDataLoggerDecorator;
use Bank131\SDK\Services\Middleware\AuthenticateMiddleware;
use Bank131\SDK\Services\Middleware\ExceptionsHandlerMiddleware;
use Bank131\SDK\Services\Middleware\LogRequestsMiddleware;
use Bank131\SDK\Services\Security\SignatureGenerator;
use Bank131\SDK\Services\Serializer\JsonSerializer;
use Bank131\SDK\Services\Serializer\SerializerInterface;
use Bank131\SDK\Services\WebHook\Hook\AbstractWebHook;
use Bank131\SDK\Services\WebHook\WebHookHandlerFactory;
use Bank131\SDK\Services\WebHook\WebHookHandlerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class Client implements LoggerAwareInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var LoggerInterface|NullLogger
     */
    private $logger;

    /**
     * @var WebHookHandlerInterface|null
     */
    private $webHookHandler;

    /**
     * Client constructor.
     *
     * @psalm-suppress PossiblyNullArgument
     *
     * @param Config                       $config
     * @param ClientInterface|null         $client
     * @param SerializerInterface|null     $serializer
     * @param LoggerInterface|null         $logger
     * @param WebHookHandlerInterface|null $webHookHandler
     */
    public function __construct(
        Config $config,
        ?ClientInterface $client = null,
        ?SerializerInterface $serializer = null,
        ?LoggerInterface $logger = null,
        ?WebHookHandlerInterface $webHookHandler = null
    ) {
        $this->serializer = $serializer ?? new JsonSerializer();
        $this->setLogger($logger ?? new NullLogger());

        $this->client = $client ?? $this->createHttpClient($config, $this->serializer, $this->logger);
        $this->webHookHandler = $webHookHandler;

        if (!$this->webHookHandler && $config->hasBank131PublicKey()) {
            $this->webHookHandler = WebHookHandlerFactory::create($config->getBank131PublicKey(), $this->serializer);
        }
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = new SensitiveDataLoggerDecorator($logger);
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    /**
     * @param string $sign
     * @param string $body
     *
     * @return AbstractWebHook
     * @throws Exception\InvalidSignatureException
     */
    public function handleWebHook(string $sign, string $body): AbstractWebHook
    {
        if (!$this->webHookHandler) {
            throw new InvalidArgumentException(
                'WebHook handler was not instantiated. To instantiate handler your config object must contain Bank131 public key'
            );
        }

        return $this->webHookHandler->handle($sign, $body);
    }

    /**
     * @return SessionApi
     */
    public function session(): SessionApi
    {
        return new SessionApi($this);
    }

    /**
     * @return WidgetApi
     */
    public function widget(): WidgetApi
    {
        return new WidgetApi($this);
    }


    /**
     * @return WalletApi
     */
    public function wallet(): WalletApi
    {
        return new WalletApi($this);
    }

    /**
     * @param Config              $config
     * @param SerializerInterface $serializer
     * @param LoggerInterface     $logger
     *
     * @return ClientInterface
     */
    private function createHttpClient(
        Config $config,
        SerializerInterface $serializer,
        LoggerInterface $logger
    ): ClientInterface {
        $stack = HandlerStack::create();

        $stack->remove('http_errors');
        $stack->push(
            new AuthenticateMiddleware(
                $config->getProjectId(),
                new SignatureGenerator($config->getPrivateKey())
            )
        );
        $stack->push(new ExceptionsHandlerMiddleware($serializer));
        $stack->push(new LogRequestsMiddleware($logger));

        $client = new \GuzzleHttp\Client([
            'base_uri' => $config->getUri(),
            'headers'  => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-SDK-VERSION' => Version::getVersion(),
            ],
            'handler' => $stack
        ]);

        return $client;
    }
}