<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

class FpsBank
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $eng_name;

    /**
     * @var string
     */
    private $ru_name;

    /**
     * @param string $eng_name
     * @param string $id
     * @param string $ru_name
     */
    public function __construct(string $id, string $eng_name, string $ru_name)
    {
        $this->eng_name = $eng_name;
        $this->id = $id;
        $this->ru_name = $ru_name;
    }

    public function getEngName(): string
    {
        return $this->eng_name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRuName(): string
    {
        return $this->ru_name;
    }
}
