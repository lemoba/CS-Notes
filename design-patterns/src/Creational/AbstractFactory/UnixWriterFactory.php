<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 具体工厂
class UnixWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new UnixCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new UnixJsonWriter();
    }
}
