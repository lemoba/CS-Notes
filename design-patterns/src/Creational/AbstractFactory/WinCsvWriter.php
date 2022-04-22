<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 具体类
class WinCsvWriter implements CsvWriter
{
    public function write(array $line): string
    {
        return join(',', $line) . "\r\n";
    }
}
