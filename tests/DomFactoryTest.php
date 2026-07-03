<?php

declare(strict_types=1);

use Bpstr\Elements\DomFactory;
use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class DomFactoryTest extends TestCase {

	public function testFactoryCreatesKnownHtmlElement(): void {
		$element = DomFactory::div('Hello', ['class' => 'message']);

		$this->assertInstanceOf(Element::class, $element);
		$this->assertSame(
			'<div class="message">Hello</div>',
			(string) $element
		);
	}

	public function testFactoryIgnoresUnknownHtmlElement(): void {
		$this->assertNull(DomFactory::notatag('Hello'));
	}

}
