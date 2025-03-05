<?php

declare(strict_types=1);

namespace Bank131\SDK\Services\Middleware;

use Bank131\SDK\Services\Security\SignatureGenerator;
use Psr\Http\Message\RequestInterface;

class AuthenticateMiddleware
{
    public const X_PARTNER_PROJECT_HEADER = 'x-partner-project';

    public const X_PARTNER_SIGN_HEADER = 'x-partner-sign';

    public const X_PARTNER_SUBMERCHAT_HEADER = 'x-partner-submerchant';

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string|null
     */
    private $submerchant;

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
    public function __construct(
        string $projectId,
        SignatureGenerator $signatureGenerator,
        ?string $submerchant = null
    ) {
        $this->projectId = $projectId;
        $this->signatureGenerator = $signatureGenerator;
        $this->submerchant = $submerchant;
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
                ->withHeader(
                    self::X_PARTNER_SIGN_HEADER,
                    $this->signatureGenerator->generate(
                        (string) $request->getBody()
                    )
                );

            if ($this->submerchant !== null && trim($this->submerchant) !== '') {
                $authenticatedRequest = $authenticatedRequest->withHeader(
                    self::X_PARTNER_SUBMERCHAT_HEADER,
                    $this->submerchant
                );
            }

            return $next($authenticatedRequest, $options);
        };
    }
}