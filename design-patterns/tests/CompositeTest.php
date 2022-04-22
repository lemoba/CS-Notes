<?php

declare(strict_types=1);

namespace DsignPatterns\Testing;

use PHPUnit\Framework\TestCase;
use DsignPatterns\Structural\Composite\Form;
use DsignPatterns\Structural\Composite\TextElement;
use DsignPatterns\Structural\Composite\InputElement;

/**
 * CompositeTest
 * @group composite
 */
class CompositeTest extends TestCase
{
    /** @covers */
    public function testRender()
    {
        $form = new Form();
        $form->addElement(new TextElement('Email:'));
        $form->addElement(new InputElement());

        $embed = new Form();
        $embed->addElement(new TextElement('Password:'));
        $embed->addElement(new InputElement());

        $form->addElement($embed);

        $this->assertSame(
            '<form>Email:<input type="text" /><form>Password:<input type="text" /></form></form>',
            $form->render()
        );
    }
}
