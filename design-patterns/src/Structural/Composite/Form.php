<?php

declare(strict_types=1);

namespace DsignPatterns\Structural\Composite;

class Form implements Renderable
{
    private array $elements;

    public function render(): string
    {
        $formCode = '<form>';

        foreach ($this->elements as $elements) {
            $formCode .= $elements->render();
        }

        return $formCode . '</form>';
    }

    public function addElement(Renderable $element)
    {
        $this->elements[] = $element;
    }
}
