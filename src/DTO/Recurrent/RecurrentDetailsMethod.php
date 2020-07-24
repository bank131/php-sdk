<?php
declare(strict_types=1);

namespace Bank131\SDK\DTO\Recurrent;


class RecurrentDetailsMethod
{
    /**
     * @var string
     */
    private $token;

    /**
     * RecurrentDetailsMethod constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
