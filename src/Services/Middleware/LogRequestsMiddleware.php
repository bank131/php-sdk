<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class LogRequestsMiddleware
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LogRequestsMiddleware constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @psalm-suppress MissingClosureReturnType
     * @psalm-suppress MixedMethodCall
     *
     * @param callable $next
     *
     * @return callable
     */
    public function __invoke(callable $next): callable
    {
        return function (RequestInterface $request, array $options = []) use ($next) {
            $requestId = $this->generateRequestId();

            $this->logRequest($request, $requestId);

            return $next($request, $options)->then(
                function (ResponseInterface $response) use ($requestId) {
                    $this->logResponse($response, $requestId);

                    return $response;
                }
            );
        };
    }

    /**
     * @param RequestInterface $request
     * @param string           $requestId
     */
    private function logRequest(RequestInterface $request, string $requestId): void
    {
        $context = [];

        /** @var array $body */
        $body = json_decode((string)$request->getBody(), true);

        if ($body && JSON_ERROR_NONE === json_last_error()) {
            $context['http-body'] = $body;
        }

        $this->logger->info(
            sprintf(
                'Send request: Id - `%s` `%s %s`. Headers: `%s`.',
                $requestId,
                $request->getMethod(),
                $request->getUri()->getPath(),
                json_encode($request->getHeaders())
            ),
            $context
        );
    }

    /**
     * @param ResponseInterface $response
     * @param string            $requestId
     */
    private function logResponse(ResponseInterface $response, string $requestId): void
    {
        $context = [];

        /** @var array $body */
        $body = json_decode((string)$response->getBody(), true);

        if ($body && JSON_ERROR_NONE === json_last_error()) {
            $context['http-body'] = $body;
        }

        $this->logger->info(
            sprintf(
                'Response received. Id: `%s`. Code: `%s`. Headers: `%s`.',
                $requestId,
                $response->getStatusCode(),
                json_encode($response->getHeaders())
            ),
            $context
        );
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    private function generateRequestId(): string
    {
        return substr(
            md5(microtime().random_int(1000, mt_getrandmax())),
            0,
            8
        );
    }
}