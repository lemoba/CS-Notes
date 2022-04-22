<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use DsignPatterns\Creational\StaticFactory\Formatter;
use DsignPatterns\Creational\StaticFactory\StaticFactory;

/**
 * StaticFactoryTest
 * @group staticfactory
 */
class StaticFactoryTest extends TestCase
{
    /**
     * @covers
     * @test
     */
    public function testCanCreateNumberFormatter()
    {
        $this->assertInstanceOf(Formatter::class, StaticFactory::factory('number'));
    }

    /**
    * @covers
    * @test
    */
    public function testCanCreateStringFormatter()
    {
        $this->assertInstanceOf(Formatter::class, StaticFactory::factory('string'));
    }

    /**
     * @covers
     * @test
     */
    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        StaticFactory::factory('object');
    }
}
