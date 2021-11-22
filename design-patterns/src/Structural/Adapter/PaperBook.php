<?php declare(strict_types=1);

namespace DsignPatterns\Structural\Adapter;

class PaperBook implements Book
{
    private int $page;

    public function turnPage()
    {
        $this->page++;
    }

    public function open()
    {
        $this->page = 1;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}