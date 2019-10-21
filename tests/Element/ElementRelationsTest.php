<?php

declare(strict_types=1);

use Bpstr\Elements\Base\Markup;
use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class ElementRelationsTest extends TestCase {

	public function testElementWithoutContent(): void {
		$div = Element::create('p', 'Lorem ipsum.');
		$div->before(Element::create('nav'));
		$div->after(Element::create('div'));
		$div->wrap(Element::create('section'));

		$this->assertSame(
			'<section><nav></nav><p>Lorem ipsum.</p><div></div></section>',
			(string) $div
		);
	}

}
