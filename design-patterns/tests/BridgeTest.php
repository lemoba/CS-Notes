<?php declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Structural\Bridge\HtmlFormatter;
use DsignPatterns\Structural\Bridge\HelloWorldService;
use DsignPatterns\Structural\Bridge\PlainTextFormatter;

/**
 * BridgeTest
 * @group bridge
 */
class BridgeTest extends TestCase
{
    /** 
     * @covers
     */
    public function testCanPrintUsingThePlainTextFormatter()
    {
        $service = new HelloWorldService(new PlainTextFormatter());
        
        $this->assertSame('Hello World', $service->get());
    }

    /** 
     * @covers
     */
    public function testCanPrintUsingTheHtmlFormatter()
    {
        $service = new HelloWorldService(new HtmlFormatter());
        
        $this->assertSame('<p>Hello World</p>', $service->get());
    }

}
