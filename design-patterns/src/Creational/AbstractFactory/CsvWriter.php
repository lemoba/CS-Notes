<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 抽象类(接口)
interface CsvWriter
{
    public function write(array $line): string;
}
