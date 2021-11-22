<?php declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 抽象类(接口)
interface JsonWriter
{
    public function write(array $data, bool $formated): string;
}