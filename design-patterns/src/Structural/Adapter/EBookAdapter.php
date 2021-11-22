<?php declare(strict_types=1);

namespace DsignPatterns\Structural\Adapter;

use DsignPatterns\Structural\Adapter\EBook;

class EBookAdapter implements Book
{
    public function __construct(protected EBook $eBook)
    {
    }

    public function turnPage()
    {
        $this->eBook->unlock();
    }

    public function open()
    {
        $this->eBook->pressNext();
    }

    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}