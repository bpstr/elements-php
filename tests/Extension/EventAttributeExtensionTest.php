<?php

declare(strict_types=1);

use Bpstr\Elements\Extension\EventAttribute;
use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class EventAttributeExtensionTest extends TestCase {

	public function testDocument(): void {
		$element = Element::create('div');
		EventAttribute::attach($element)->onClick('call');

		$this->assertSame(
			'<div onclick="call"></div>',
			(string) $element
		);
	}

}
