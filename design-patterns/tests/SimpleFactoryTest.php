<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use DsignPatterns\Creational\SimpleFactory\Bicycle;
use PHPUnit\Framework\TestCase;
use DsignPatterns\Creational\SimpleFactory\SimpleFactory;

/**
 * SimpleFactoryTest
 * @group simplefactory
 */
class SimpleFactoryTest extends TestCase
{
    /**
     * @covers
     * @test
     */
    public function testCanCreateBicyle()
    {
        // Test
        $bicyle = (new SimpleFactory())->createBicycle();
        $this->assertInstanceOf(Bicycle::class, $bicyle);
    }
}
