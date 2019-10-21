<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class ElementBaseTest extends TestCase {

	public function testElementWithoutTag(): void {
		$this->expectException(InvalidArgumentException::class);
		Element::create('');
	}

	public function testElementSetTag(): void {
		$div = Element::create('div');
		$div->setTag('p');

		$this->assertSame(
			'<p></p>',
			(string) $div
		);
	}

	public function testElementWithoutContent(): void {
		$div = Element::create('div');

		$this->assertSame(
			'<div></div>',
			(string) $div
		);
	}

	public function testElementWithContent() {
		$div = Element::create('p', 'Lorem ipsum dolor sit amet.');

		$this->assertSame(
			'<p>Lorem ipsum dolor sit amet.</p>',
			(string) $div
		);
	}

	public function testElementWithContentAndAttributes() {
		$div = Element::create('a', 'This is a link.', ['href' => '#']);

		$this->assertSame(
			'<a href="#">This is a link.</a>',
			(string) $div
		);
	}

	public function testElementMultipleAttributes() {
		$div = Element::create('img', NULL, ['src' => 'image.jpg', 'width' => 500]);
		$div->setAttribute('height', '600');

		$this->assertSame(
			'<img src="image.jpg" width="500" height="600" />',
			(string) $div
		);
	}

}
