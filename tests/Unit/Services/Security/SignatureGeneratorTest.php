<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\Services\Security;

use Bank131\SDK\Exception\InvalidArgumentException;
use Bank131\SDK\Services\Security\SignatureGenerator;
use PHPUnit\Framework\TestCase;

class SignatureGeneratorTest extends TestCase
{
    /**
     * @var SignatureGenerator
     */
    private $service;

    protected function setUp(): void
    {
        $this->service = new SignatureGenerator(
            file_get_contents(
                __DIR__ . '/../../../Fixtures/keys/private.pem'
            )
        );
    }

    /**
     * @dataProvider getGenerateSignatureProvider
     * @param string $data
     * @param string $expectedSignature
     */
    public function testGenerateSignature(string $data, string $expectedSignature): void
    {
        $generatedSignature = $this->service->generate($data);
        $this->assertEquals($expectedSignature, $generatedSignature);
    }

    public function getGenerateSignatureProvider(): array
    {
        return [
            [
                '{}',
                'Q+euWta2W3WhIHq/t3Gkvqbvf5RztorP41mbIW21nKDDeaLw0FQuGCg4rwjN/scjFYk1+kBfP+8gau3hDm7uaUyke5Kz44UkbOMVTpZROqS/ozqHllgHp7aatEDKil9WXAYadl8PlbhzbjgeDL1hvbEUyEzfaIxrZASNX9kZ08ORBGZCg76iEJ/HI5/I+QUdI3sEBPTn4gy88sPhlm5vYH1dVlPuMEDWTW7w7zVnV0hUvGeVygyJAW5Q3KbKtdQWajQJH9dPzISfV1rfczHu4YnewkyEOASPg+HpiEJOxxeZRnUONzkavUJEaCznNApWIR0C0stlRItaN+EBNTKvUw=='
            ],
        ];
    }

    public function testPrivateKeyWrongFormat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $service = new SignatureGenerator('wrong_private_key_format');
    }
}