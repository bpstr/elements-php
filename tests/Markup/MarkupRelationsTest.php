<?php

declare(strict_types=1);

use Bpstr\Elements\Base\Markup;
use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class MarkupRelationsTest extends TestCase {

	public function testElementWithoutContent(): void {
		$div = Markup::create('base', 'Lorem ipsum.');
		$div->before(Element::create('before'));
		$div->after(Element::create('after'));
		$div->wrap(Element::create('document'));

		$this->assertSame(
			'<document><before></before><base>Lorem ipsum.</base><after></after></document>',
			(string) $div
		);
	}

}
