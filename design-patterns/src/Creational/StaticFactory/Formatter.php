<?php declare(strict_types=1);

namespace DsignPatterns\Creational\StaticFactory;

interface Formatter
{
    public function format(string $input): string;
}