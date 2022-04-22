<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\FactoryMethod;

interface LoggerFactory
{
    public function createLogger(): Logger;
}
