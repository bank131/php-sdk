<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Middleware;

use Bank131\SDK\API\Response\ErrorResponse;
use Bank131\SDK\Exception\ApiException;
use Bank131\SDK\Exception\Bank131Exception;
use Bank131\SDK\Exception\IdempotencyKeyAlreadyExistsException;
use Bank131\SDK\Services\Serializer\SerializerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExceptionsHandlerMiddleware
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * ExceptionsHandlerMiddleware constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @psalm-suppress MissingClosureReturnType
     * @psalm-suppress MixedMethodCall
     *
     * @param callable $next
     *
     * @return \Closure
     */
    public function __invoke(callable $next)
    {
        return function (RequestInterface $request, array $options = []) use ($next) {
            return $next($request, $options)->then(
                function (ResponseInterface $response) use ($request) {
                    $code = $response->getStatusCode();
                    if ($code >= 400) {
                        $this->handleErrorResponse($response);
                    }
                    return $response;
                }
            );
        };
    }

    /**
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress MixedArgument
     *
     * @param ResponseInterface $response
     *
     * @throws Bank131Exception
     */
    private function handleErrorResponse(ResponseInterface $response): void
    {
        $body = (string) $response->getBody();

        if ($body && $this->isValidJson($body)) {
            /** @var ErrorResponse $errorResponse */
            $errorResponse = $this->serializer->deserialize((string) $response->getBody(), ErrorResponse::class);

            if ($errorResponse->getError() !== null) {
                $code = $errorResponse->getError()->getCode();
                $description = $errorResponse->getError()->getDescription();
            }
        }

        $code = $code ?? ApiException::DEFAULT_EXCEPTION_CODE;

        if ($code === IdempotencyKeyAlreadyExistsException::IDEMPOTENCY_KEY_ALREADY_EXISTS_CODE) {
            throw new IdempotencyKeyAlreadyExistsException(
                $code,
                $description ?? '',
                $response->getStatusCode()
            );
        }

        throw new ApiException(
            $code,
            $description ?? '',
            $response->getStatusCode()
        );
    }

    /**
     * Checks if string is valid json string
     *
     * @param string $jsonString
     *
     * @return bool
     */
    private function isValidJson(string $jsonString): bool
    {
        json_decode($jsonString);

        return (json_last_error() === JSON_ERROR_NONE);
    }
}