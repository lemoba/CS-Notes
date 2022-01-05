<?php declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Creational\Prototype\BarBookPrototype;
use DsignPatterns\Creational\Prototype\FooBookPrototype;

/**
 * PrototypeTest
 * @group prototype
 */
class PrototypeTest extends TestCase
{
    /** 
     * @covers
     * @test 
     */
    public function testCanGetFooBook()
    {
        // Test
        $fooProtoType = new FooBookPrototype();
        $barProtoType = new BarBookPrototype();

        for ($i = 0; $i < 10; $i++) {
            $book = clone $fooProtoType;
            $book->setTitle('Foo Book No ' . $i);
            $this->assertInstanceOf(FooBookPrototype::class, $book);
        }

        for ($i = 0; $i < 5; $i++) {
            $book = clone $barProtoType;
            $book->setTitle('Bar Book No ' . $i);
            $this->assertInstanceOf(BarBookPrototype::class, $book);
        }
    }

}
