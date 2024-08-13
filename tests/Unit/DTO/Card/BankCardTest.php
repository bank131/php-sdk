<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\DTO\Card;

use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\Exception\InvalidArgumentException;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class BankCardTest
 *
 * @package Bank131\SDK\Tests\Unit\DTO\Card
 */
class BankCardTest extends TestCase
{

    /**
     * Test construct success
     *
     * @doesNotPerformAssertions
     */
    public function testConstructSuccess()
    {
        $expDate = (new DateTime())->modify('+1 year');
        new BankCard(
            $cardNumber = '4200800080008801',
            $expDate->format('m'),
            substr($expDate->format('Y'), 2, 2),
            '123',
            'test test'
        );
    }

    /**
     * Test construct with invalid date failure
     *
     * @testWith ["dsfgsf", "11"]
     *           ["12", "zcsdf"]
     *           ["12", "1234"]
     *           ["123", "99"]
     *           ["12", "99", "4200800080"]
     *           ["12", "99", "4200800080008801", "12345"]
     */
    public function testConstructWithInvalidParamsFailure(
        string $month,
        string $year,
               $cardNumber = '4200800080008801',
               $cvv = '123'
    ) {
        $this->expectException(InvalidArgumentException::class);

        $t = new BankCard(
            $cardNumber,
            $month,
            $year,
            $cvv,
            'test test'
        );
    }
}
