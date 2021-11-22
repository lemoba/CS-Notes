<?php declare(strict_types=1);

namespace DsignPatterns\Structural\Composite;

class TextElement implements Renderable
{
    public function __construct(private string $text)
    {       
    }

    public function render(): string
    {
        return $this->text;
    }
}