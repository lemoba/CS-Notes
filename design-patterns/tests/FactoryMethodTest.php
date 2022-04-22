<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Creational\FactoryMethod\FileLogger;
use DsignPatterns\Creational\FactoryMethod\StdoutLogger;
use DsignPatterns\Creational\FactoryMethod\FileLoggerFactory;
use DsignPatterns\Creational\FactoryMethod\StdoutLoggerFactory;

/**
 * FactoryMethodTest
 * @group factorymethod
 */
class FactoryMethodTest extends TestCase
{
    /**
     * @test
     * @covers
     */
    public function testCanCreateStdoutLogging()
    {
        $loggerFactory = new StdoutLoggerFactory();
        $logger = $loggerFactory->createLogger();

        $this->assertInstanceOf(StdoutLogger::class, $logger);
    }

    /**
     * @test
     * @covers
     */
    public function testCanCreateFileLogging()
    {
        $loggerFactory = new FileLoggerFactory(sys_get_temp_dir());
        $logger = $loggerFactory->createLogger();

        $this->assertInstanceOf(FileLogger::class, $logger);
    }
}
