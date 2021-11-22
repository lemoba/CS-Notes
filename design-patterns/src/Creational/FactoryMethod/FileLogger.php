<?php declare(strict_types=1);

namespace DsignPatterns\Creational\FactoryMethod;

class FileLogger implements Logger
{
    public function __construct(string $filePath)
    {
    }

    public function log(string $message)
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
    }
}