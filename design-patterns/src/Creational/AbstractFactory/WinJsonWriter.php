<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 具体类
class WinJsonWriter implements JsonWriter
{
    public function write(array $data, bool $formated): string
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
