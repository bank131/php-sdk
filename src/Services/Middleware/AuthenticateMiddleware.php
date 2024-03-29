<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Middleware;

use Bank131\SDK\Services\Security\SignatureGenerator;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\modify_request;

class AuthenticateMiddleware
{
    public const X_PARTNER_PROJECT_HEADER = 'x-partner-project';

    public const X_PARTNER_SIGN_HEADER = 'x-partner-sign';

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var SignatureGenerator
     */
    private $signatureGenerator;

    /**
     * AuthenticateMiddleware constructor.
     *
     * @param string             $projectId
     * @param SignatureGenerator $signatureGenerator
     */
    public function __construct(string $projectId, SignatureGenerator $signatureGenerator)
    {
        $this->projectId = $projectId;
        $this->signatureGenerator = $signatureGenerator;
    }

    /**
     * @psalm-suppress MissingClosureReturnType
     *
     * @param callable $next
     *
     * @return callable
     */
    public function __invoke(callable $next): callable
    {
        return function (RequestInterface $request, array $options = []) use ($next) {
            $authenticatedRequest = $request
                ->withHeader(self::X_PARTNER_PROJECT_HEADER, $this->projectId)
                ->withHeader(self::X_PARTNER_SIGN_HEADER,  $this->signatureGenerator->generate(
                (string) $request->getBody()
            ));

            return $next($authenticatedRequest, $options);
        };
    }
}