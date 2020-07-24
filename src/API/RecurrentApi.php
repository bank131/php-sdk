<?php

declare(strict_types=1);

namespace Bank131\SDK\API;

use Bank131\SDK\API\Enum\HttpVerbEnum;
use Bank131\SDK\API\Request\Recurrent\DisableRecurrentRequest;
use Bank131\SDK\API\Request\Recurrent\RecurrentStatusRequest;
use Bank131\SDK\API\Response\Recurrent\RecurrentStatusResponse;

class RecurrentApi extends AbstractApi
{
    protected const BASE_URI = '/api/v1/recurrent';

    /**
     * @param RecurrentStatusRequest $request
     *
     * @return RecurrentStatusResponse
     */
    public function getStatus(RecurrentStatusRequest $request): RecurrentStatusResponse
    {
        /** @var RecurrentStatusResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI.'/status',
            RecurrentStatusResponse::class,
            $request
        );

        return $response;
    }

    /**
     * @param DisableRecurrentRequest $request
     *
     * @return RecurrentStatusResponse
     */
    public function disable(DisableRecurrentRequest $request): RecurrentStatusResponse
    {
        /** @var RecurrentStatusResponse $response */
        $response = $this->request(
            HttpVerbEnum::POST,
            self::BASE_URI.'/disable',
            RecurrentStatusResponse::class,
            $request
        );

        return $response;
    }
}
