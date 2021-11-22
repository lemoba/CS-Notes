<?php declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Creational\Singleton\Singleton;

/**
 * SingletonTest
 * @group singleton
 */
class SingletonTest extends TestCase
{
    /** 
     * @covers
     * @test
     */
    public function testUniqueness()
    {
        // Test
        $firstCall = Singleton::getInstance();
        $secondCall = Singleton::getInstance();

        $this->assertInstanceOf(Singleton::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }

}
