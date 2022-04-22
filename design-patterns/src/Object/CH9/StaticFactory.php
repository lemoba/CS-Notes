<?php

namespace DsignPatterns\Object\CH9;

interface Formatter
{
    public function format(string $input): string;
}   

class FormatterNumber implements Formatter
{
    public function format(string $input): string
    {
        return 'FormatterNumber';
    }
}

class FormatterString implements Formatter
{
    public function format(string $input): string
    {
        return 'FormatterString';
    }
}

final class StaticFactory
{
    public static function build(string $name): Formatter
    {
        switch ($name) {
            case 'number':
                return new FormatterNumber();
                break;
            default:
                return new FormatterString();
        }
    }
}

$f = StaticFactory::build('number');

var_dump($f);