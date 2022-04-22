<?php

declare(strict_types=1);

namespace DsignPatterns\Structural\Bridge;

interface Formatter
{
    public function format(string $text): string;
}
