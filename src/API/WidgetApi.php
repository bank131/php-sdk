<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Widget\IssuePublicTokenRequest;
use Bank131\SDK\API\Response\Widget\PublicTokenResponse;

class WidgetApi extends AbstractApi
{
    protected const BASE_URI = 'api/v1';

    /**
     * @param IssuePublicTokenRequest $request
     *
     * @return PublicTokenResponse
     */
    public function issuePublicToken(IssuePublicTokenRequest $request): PublicTokenResponse
    {
        /** @var PublicTokenResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI . '/token',
            PublicTokenResponse::class,
            $request
        );

        return $response;
    }
}