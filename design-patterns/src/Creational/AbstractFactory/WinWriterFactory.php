<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 具体工厂
class WinWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new WinCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new WinJsonWriter();
    }
}
