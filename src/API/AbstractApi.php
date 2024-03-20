<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Request\AbstractRequest;
use Bank131\SDK\API\Request\NullRequest;
use Bank131\SDK\API\Response\AbstractResponse;
use Bank131\SDK\Client;
use Bank131\SDK\Services\Serializer\SerializerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractApi
{
    protected const BASE_URI = '/';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    protected $headers;

    /**
     * AbstractApi constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->httpClient = $client->getHttpClient();
        $this->serializer = $client->getSerializer();
        $this->headers    = [];
    }

    /**
     * @param string               $method
     * @param string               $uri
     * @param class-string         $expectedClass
     * @param AbstractRequest|null $request
     *
     * @return AbstractResponse
     * @throws GuzzleException
     */
    protected function request(
        string $method,
        string $uri,
        string $expectedClass,
        AbstractRequest $request = null
    ): AbstractResponse {
        $request = $request ?? new NullRequest();

        $body = $this->serializer->serialize($request);

        $options = ['body' => $body];

        if ($this->headers) {
            $options['headers'] = $this->headers;
        }

        $response = $this->httpClient->request(
            $method,
            $uri,
            $options
        );

        /** @var AbstractResponse $deserializedResponse */
        $deserializedResponse = $this->serializer->deserialize((string)$response->getBody(), $expectedClass);

        return $deserializedResponse;
    }

    /**
     * @return AbstractApi|static
     */
    public function withHeader(string $name, string $value)
    {
        $clone = clone $this;
        $clone->headers[$name] = $value;

        return $clone;
    }
}
