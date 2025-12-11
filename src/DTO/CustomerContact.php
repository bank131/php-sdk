<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO;

use Bank131\SDK\Exception\InvalidArgumentException;

class CustomerContact
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Email value must be a valid email');
        }

        $this->email = $email;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;

        if (!preg_match('/^\+?\d+$/', $phone)) {
            throw new InvalidArgumentException('Phone number must contains only numbers and optional `+`');
        }

        $this->phone = $phone;
    }
}