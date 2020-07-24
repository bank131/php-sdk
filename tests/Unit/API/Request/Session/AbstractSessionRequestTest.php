<?php
declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Session;

use Bank131\SDK\API\Request\Session\AbstractSessionRequest;
use Bank131\SDK\Exception\InvalidArgumentException;
use DateTime;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use stdClass;

class AbstractSessionRequestTest extends TestCase
{
    /**
     * Valid request metadata data provider
     *
     * @return array
     */
    public function validRequestMetadataDataProvider(): array
    {
        return [
            ['{"key":"value"}'],
            [['key' => 'value']],
            [1],
            [1.11],
            ['1'],
            [true],
            [null],
        ];
    }

    /**
     * Valid request metadata data provider
     *
     * @return array
     */
    public function invalidRequestMetadataDataProvider(): array
    {
        return [
            [new stdClass()],
            [new Exception()],
            [new DateTime()],
        ];
    }

    /**
     * @var AbstractSessionRequest|MockObject
     */
    private $request;

    /**
     * Test success build full session
     *
     * @param $metadata
     *
     * @dataProvider validRequestMetadataDataProvider
     * @doesNotPerformAssertions
     */
    public function testSetMetadata($metadata): void
    {
        $this->request->setMetadata($metadata);
    }

    /**
     * @param $metadata
     *
     * @dataProvider invalidRequestMetadataDataProvider
     */
    public function testSetInvalidMetadata($metadata): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->request->setMetadata($metadata);
    }

    protected function setUp(): void
    {
        $this->request = $this->getMockForAbstractClass(AbstractSessionRequest::class);
    }

}
