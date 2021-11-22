<?php declare(strict_types=1);

namespace DsignPatterns\Testing;

use DsignPatterns\Creational\AbstractFactory\CsvWriter;
use DsignPatterns\Creational\AbstractFactory\JsonWriter;
use DsignPatterns\Creational\AbstractFactory\UnixWriterFactory;
use DsignPatterns\Creational\AbstractFactory\WinWriterFactory;
use DsignPatterns\Creational\AbstractFactory\WriterFactory;
use PHPUnit\Framework\TestCase;

/**
 * AbstractFactoruTest
 * @group providefactory
 */
class AbstractFactoryTest extends TestCase
{
    public function provideFactory()
    {
        return [
            [new UnixWriterFactory()],
            [new WinWriterFactory()]
        ];
    }

    /**
     * @covers
     * @dataProvider provideFactory
     */
    public function testCanCreateCsvWriterOnUnix(WriterFactory $writerFactory)
    {
        $this->assertInstanceOf(JsonWriter::class, $writerFactory->createJsonWriter());
        $this->assertInstanceOf(CsvWriter::class, $writerFactory->createCsvWriter());
    }
}