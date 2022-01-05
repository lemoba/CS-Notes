<?php declare(strict_types=1);

namespace DsignPatterns\Structural\Decorator;

use DsignPatterns\Structural\Decorator\Booking;

abstract class BookingDecorator implements Booking
{
    public function __construct(protected Booking $booking)
    {
    }
}