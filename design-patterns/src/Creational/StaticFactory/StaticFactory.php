<?php declare(strict_types=1);

namespace DsignPatterns\Creational\StaticFactory;

use InvalidArgumentException;

final class StaticFactory
{
    public static function factory(string $type): Formatter
    {
        if ($type == 'number') {
            return new FormatNumber();
        }else if ($type == 'string') {
            return new FormatString();
        }

        throw new InvalidArgumentException('Unknown format given');
    }
}

