<?php

declare(strict_types=1);

namespace DsignPatterns\Structural\Decorator;

use DsignPatterns\Structural\Decorator\Booking;

class DoubleRoomBooking implements Booking
{
    public function calculatePrice(): int
    {
        return 666;
    }

    public function getDescription(): string
    {
        return 'double room';
    }
}
