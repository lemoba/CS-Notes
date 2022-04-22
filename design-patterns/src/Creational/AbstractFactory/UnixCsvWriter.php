<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 具体类
class UnixCsvWriter implements CsvWriter
{
    public function write(array $line): string
    {
        return join(',', $line) . "\n";
    }
}
