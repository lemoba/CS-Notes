<?php declare(strict_types=1);

namespace DsignPatterns\Creational\Pool;

class StringReverseWorker
{
    public function __construct()
    {

    }

    public function run(string $text): string
    {
        return strrev($text);
    }
}