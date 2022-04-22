<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Structural\Decorator\DoubleRoomBooking;

/**
 * DecoratorTest
 * @group docorator
 */
class DecoratorTest extends TestCase
{
    /** @covers */
    public function testCanCalculatePriceForBasicDoubleRoomBooking()
    {
        // Test
        $booking = new DoubleRoomBooking();

        $this->assertSame(666, $booking->calculatePrice());
        $this->assertSame('double room', $booking->getDescription());
    }
}
