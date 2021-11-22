<?php declare(strict_types=1);

namespace DsignPatterns\Creational\FactoryMethod;

interface Logger
{
    public function log(string $message);
}