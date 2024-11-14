<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HeaderEnum;
use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Session\InitMultiSessionRequest;
use Bank131\SDK\API\Response\Session\SessionResponse;
use GuzzleHttp\Exception\GuzzleException;

class MultiSessionApi extends AbstractApi
{
    // TODO: change to v2
    protected const BASE_URI = 'api/v1/session';

    /**
     * @return SessionResponse
     * @throws GuzzleException
     */
    public function initSession(InitMultiSessionRequest $request): SessionResponse
    {
        /** @var SessionResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI.'/init/session',
            SessionResponse::class,
            $request
        );

        return $response;
    }

    public function withIdempotencyKey(string $key): MultiSessionApi
    {
        return $this->withHeader(HeaderEnum::IDEMPOTENCY_KEY, $key);
    }
}
