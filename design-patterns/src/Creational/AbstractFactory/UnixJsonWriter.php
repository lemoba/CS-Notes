<?php

declare(strict_types=1);

namespace DsignPatterns\Creational\AbstractFactory;

// 具体类
class UnixJsonWriter implements JsonWriter
{
    public function write(array $data, bool $formated): string
    {
        $options = 0;

        if ($formated) {
            $options = JSON_PRETTY_PRINT;
        }

        return json_encode($data, $options);
    }
}
