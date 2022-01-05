<?php declare(strict_types=1);

namespace DsignPatterns\Structural\Composite;

interface Renderable
{
    public function render(): string;
}