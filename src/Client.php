<?php

declare(strict_types=1);

namespace Bank131\SDK;

use Bank131\SDK\API\FpsApi;
use Bank131\SDK\API\MultiSessionApi;
use Bank131\SDK\API\RecurrentApi;
use Bank131\SDK\API\SberPayApi;
use Bank131\SDK\API\SessionApi;
use Bank131\SDK\API\SubscriptionApi;
use Bank131\SDK\API\TokenApi;
use Bank131\SDK\API\WalletApi;
use Bank131\SDK\API\WidgetApi;
use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Exception\InvalidConfigurationException;
use Bank131\SDK\Services\Logger\SensitiveDataLoggerDecorator;
use Bank131\SDK\Services\Middleware\AuthenticateMiddleware;
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
     * @var ClientInterface|null
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
     * @param Config|null                  $config
     * @param ClientInterface|null         $client
     * @param SerializerInterface|null     $serializer
     * @param LoggerInterface|null         $logger
     * @param WebHookHandlerInterface|null $webHookHandler
     */
    public function __construct(
        ?Config $config = null,
        ?ClientInterface $client = null,
        ?SerializerInterface $serializer = null,
        ?LoggerInterface $logger = null,
        ?WebHookHandlerInterface $webHookHandler = null
    ) {
        $this->serializer = $serializer ?? new JsonSerializer();
        $this->setLogger($logger ?? new NullLogger());

        if ($client !== null) {
            $this->client = $client;
        } elseif ($config !== null) {
            $this->client = HttpClientFactory::create($this->serializer, $this->logger, [], $config);
        } else {
            $this->client = null;
        }

        $this->webHookHandler = $webHookHandler;

        if (!$this->webHookHandler && $config && $config->hasBank131PublicKey()) {
            $this->webHookHandler = WebHookHandlerFactory::create($config->getBank131PublicKey(), $this->serializer);
        }
    }

    /**
     * @psalm-suppress PossiblyNullArgument
     *
     * @param Config $config
     *
     * @return $this
     */
    public function withConfig(Config $config): self
    {
        if ($this->client !== null) {
            /** @var array $httpClientConfig */
            $httpClientConfig = $this->client->getConfig();

            $httpClientConfig['base_uri']         = $config->getUri();
            $httpClientConfig['timeout']          = $config->getTimeout();
            $httpClientConfig['connect_timeout']  = $config->getConnectTimeout();

            /** @var HandlerStack|null $handlerStack */
            $handlerStack = $this->client->getConfig('handler');

            if ($handlerStack instanceof HandlerStack) {
                $clonedStack = clone $handlerStack;

                $clonedStack->remove(AuthenticateMiddleware::class);
                $clonedStack->push(
                    new AuthenticateMiddleware(
                        $config->getProjectId(),
                        new SignatureGenerator($config->getPrivateKey()),
                        $config->getSubmerchant()
                    ),
                    AuthenticateMiddleware::class
                );

                $httpClientConfig['handler']  = $clonedStack;
            }

            $httpClient = new \GuzzleHttp\Client($httpClientConfig);
        } else {
            $httpClient = HttpClientFactory::create($this->serializer, $this->logger, [], $config);
        }

        $clone = clone $this;

        if (!$clone->webHookHandler && $config->hasBank131PublicKey()) {
            $clone->webHookHandler = WebHookHandlerFactory::create($config->getBank131PublicKey(), $clone->serializer);
        }

        $clone->client = $httpClient;

        return $clone;
    }

    /**
     * @return ClientInterface
     * @throws InvalidConfigurationException
     */
    public function getHttpClient(): ClientInterface
    {
        if ($this->client === null) {
            throw new InvalidConfigurationException(
                sprintf(
                    'HTTP client has not been instantiated.
                    You should pass a `%s` object as the first argument or an instance of the `%s` interface as the second argument when instantiating `%s` object',
                    Config::class,
                    ClientInterface::class,
                    self::class
                )
            );
        }

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
     * @return SessionApi
     */
    public function sessionV1(): SessionApi
    {
        $api = new SessionApi($this);
        $api->setToV1();

        return $api;
    }

    public function multiSession(): MultiSessionApi
    {
        return new MultiSessionApi($this);
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
     * @return RecurrentApi
     */
    public function recurrent(): RecurrentApi
    {
        return new RecurrentApi($this);
    }

    /**
     * @return SubscriptionApi
     */
    public function subscription(): SubscriptionApi
    {
        return new SubscriptionApi($this);
    }

    /**
     * @return TokenApi
     */
    public function token(): TokenApi
    {
        return new TokenApi($this);
    }

    public function fps(): FpsApi
    {
        return new FpsApi($this);
    }

    /**
     * @return SberPayApi
     */
    public function sberPay(): SberPayApi
    {
        return new SberPayApi($this);
    }
}
