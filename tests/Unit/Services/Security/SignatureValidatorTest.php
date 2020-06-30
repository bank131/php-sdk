<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Security;

use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Exception\InvalidSignatureException;
use Bank131\SDK\Services\Security\SignatureValidator;
use PHPUnit\Framework\TestCase;

class SignatureValidatorTest extends TestCase
{
    /**
     * @var SignatureValidator
     */
    private $validator;

    protected function setUp(): void
    {
       $this->validator = new SignatureValidator(
           file_get_contents(__DIR__ . '/../../../Fixtures/keys/public.pem')
       );
    }

    /**
     * @dataProvider getCorrectValidateSignatureProvider
     *
     * @param string $base64signature
     * @param string $data
     *
     * @throws InvalidSignatureException
     */
    public function testCorrectValidateSignature(string $base64signature, string $data): void
    {
        $this->validator->validate($base64signature, $data);
        $this->assertTrue(true);
    }

    public function getCorrectValidateSignatureProvider(): array
    {
        return [
            [
                'Q+euWta2W3WhIHq/t3Gkvqbvf5RztorP41mbIW21nKDDeaLw0FQuGCg4rwjN/scjFYk1+kBfP+8gau3hDm7uaUyke5Kz44UkbOMVTpZROqS/ozqHllgHp7aatEDKil9WXAYadl8PlbhzbjgeDL1hvbEUyEzfaIxrZASNX9kZ08ORBGZCg76iEJ/HI5/I+QUdI3sEBPTn4gy88sPhlm5vYH1dVlPuMEDWTW7w7zVnV0hUvGeVygyJAW5Q3KbKtdQWajQJH9dPzISfV1rfczHu4YnewkyEOASPg+HpiEJOxxeZRnUONzkavUJEaCznNApWIR0C0stlRItaN+EBNTKvUw==',
                '{}'
            ],
        ];
    }

    public function testIncorrectValidateSignature(): void
    {
        $this->expectException(InvalidSignatureException::class);
        $this->validator->validate('broken_signature', '{}');
    }

    public function testPrivateKeyWrongFormat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $service = new SignatureValidator('wrong_public_key_format');
    }
}