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

	public function testScriptUsesEndpointAndDefaultAttributes(): void {
		$script = EventAttribute::script('/endpoint/', ['token' => 'abc 123']);
		$markup = (string) $script;

		$this->assertStringContainsString('<script type="text/javascript">', $markup);
		$this->assertStringContainsString('var defaults={"token":"abc 123"};', $markup);
		$this->assertStringContainsString('"/endpoint/"+callback', $markup);
		$this->assertStringContainsString('Object.assign({},defaults,attributes||{})', $markup);
		$this->assertStringContainsString('encodeURIComponent(params[key])', $markup);
	}

}
