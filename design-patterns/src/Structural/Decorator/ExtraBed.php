<?php

declare(strict_types=1);

namespace DsignPatterns\Structural\Decorator;

use DsignPatterns\Structural\Decorator\BookingDecorator;

class ExtraBed extends BookingDecorator
{
    private const PRICE = 30;

    public function calculatePrice(): int
    {
        return $this->booking->calculatePrice() + self::PRICE;
    }

    public function getDescription(): string
    {
        return $this->booking->getDescription() . 'with extra bed';
    }
}
