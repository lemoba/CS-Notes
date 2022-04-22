<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Structural\Adapter\Kindle;
use DsignPatterns\Structural\Adapter\PaperBook;
use DsignPatterns\Structural\Adapter\EBookAdapter;

/**
 * AdapterTest
 * @group adapter
 */
class AdapterTest extends TestCase
{
    /**
     * @covers
     */
    public function testCanTurnPageOnBook()
    {
        // Test
        $book = new PaperBook();
        $book->open();
        $book->turnPage();
        $this->assertSame(2, $book->getPage());
    }

    /**
     * @covers
     */
    public function testCanTurnPageOnKindleLikeInANormalBook()
    {
        // Test
        $kindle = new Kindle();
        $book = new EBookAdapter($kindle);

        $book->open();
        $book->turnPage();

        $this->assertSame(1, $book->getPage());
    }
}
