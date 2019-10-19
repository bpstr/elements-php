<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class ElementAttributeTest extends TestCase {

	public function testElementWithInvalidAttributes() {
		$this->expectException(InvalidArgumentException::class);
		Element::create('div', 'This is a div.', ['title' => []]);
	}

	public function testElementWithInvalidObjectAttributes() {
		$this->expectException(InvalidArgumentException::class);
		Element::create('a', 'This is a link.', ['href' => new class {}]);
	}

	public function testElementWithObjectAttributes() {
		$attr = new class {

			public function __toString() {
				return '#';
			}
		};

		$anchor = Element::create('a', 'This is a link.', ['href' => $attr]);
		$this->assertSame('<a href="#">This is a link.</a>', (string) $anchor);
	}

	public function testElementClassAttribute(): void {
		$div = Element::create('div', 'Lorem ipsum.');
		$div->addClass('test', 'class', 'list', 'test');

		$this->assertSame(
			'<div class="test class list">Lorem ipsum.</div>',
			(string) $div
		);
	}

	public function testElementStyleAttribute(): void {
		$div = Element::create('div', 'Lorem ipsum.');
		$div->setStyle('color', 'white');

		$this->assertSame(
			'<div style="color: white;">Lorem ipsum.</div>',
			(string) $div
		);
	}

	public function testElementMultipleStyleAttribute(): void {
		$div = Element::create('div', 'Lorem ipsum.');
		$div->setStyle('color', 'white');
		$div->setStyle('font-weight', 'bold');

		$this->assertSame(
			'<div style="color: white; font-weight: bold;">Lorem ipsum.</div>',
			(string) $div
		);
	}

	public function testElementOverrideStyleAttribute(): void {
		$div = Element::create('div', 'Lorem ipsum.');
		$div->setStyle('color', 'white');
		$div->setStyle('font-weight', 'bold');
		$div->setStyle('color', 'black');

		$this->assertSame(
			'<div style="color: black; font-weight: bold;">Lorem ipsum.</div>',
			(string) $div
		);
	}

	public function testElementApostropheAttribute(): void {
		$div = Element::create('p', 'This is a paragraph.');
		$div->setAttribute('title', 'I"m a tooltip');

		$this->assertSame(
			'<p title="I\'m a tooltip">This is a paragraph.</p>',
			(string) $div
		);
	}

	public function testElementMultipleAttributes() {
		$img = Element::create('img', NULL, ['src' => 'image.jpg', 'width' => 500]);
		$img->setAttribute('height', '600');

		$this->assertSame(
			'<img src="image.jpg" width="500" height="600" />',
			(string) $img
		);
	}

	public function testElementHasClassMethod() {
		$div = Element::create('div', 'Lorem ipsum.', ['class' => 'full width and height', 'width' => 500, 'height' => '12']);

		$this->assertTrue($div->hasAttribute('width'));
		$this->assertTrue($div->hasAttribute('height'));
		$this->assertFalse($div->hasAttribute('unnamed'));

		$div->removeAttribute('width', 'height', 'unnamed');

		$this->assertTrue($div->hasClass('width'));
		$div->removeClass('width');

		$this->assertTrue($div->hasClass('height'));
		$div->removeClass('height');

		$this->assertSame(
			'<div class="full and">Lorem ipsum.</div>',
			(string) $div
		);
	}

}
