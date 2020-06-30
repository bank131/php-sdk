<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\CustomerInteraction;

class Redirect
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $base_url;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array|null
     */
    private $qs;

    /**
     * @var array|null
     */
    private $params;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->base_url;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array|null
     */
    public function getQs(): ?array
    {
        return $this->qs;
    }

    /**
     * @return array|null
     */
    public function getParams(): ?array
    {
        return $this->params;
    }
}