<?php declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 抽象工厂基类(接口)
interface WriterFactory
{
    public function createCsvWriter(): CsvWriter;
    public function createJsonWriter(): JsonWriter;
}