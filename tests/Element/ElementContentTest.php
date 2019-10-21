<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class ElementContentTest extends TestCase {

	public function testPrependAppendContent(): void {
		$element = Element::create('div', 'ipsum dolor');
		$element->appendContent(' sit amet.');
		$element->prependContent('Lorem ');

		$this->assertSame(
			'<div>Lorem ipsum dolor sit amet.</div>',
			(string) $element
		);
	}

	public function testPlaceContent(): void {
		$element = Element::create('div', 'ipsum dolor');
		$element->placeContent(1, ' sit amet.');
		$element->prependContent('Lorem ');

		$this->assertSame(
			'<div>Lorem ipsum dolor sit amet.</div>',
			(string) $element
		);
	}

	public function testPlaceAndRemoveContent(): void {
		$element = Element::create('div', 'Lorem ipsum.');
		$element->placeContent(Element::CKEY_DEFAULT_CONTENT, 'Dolorem');
		$element->appendContent(' Dolor sit amet.');

		$this->assertSame(
			'<div>Dolorem Dolor sit amet.</div>',
			(string) $element
		);
	}

	public function testAppendPrependContent(): void {
		$element = Element::create('div', 'ipsum dolor');

		$element->prependContent(['Lorem', 1]);

		$element->appendContent([' sit amet.', 'asd']);

		$this->assertSame(
			'<div>1Loremipsum dolor sit amet.asd</div>',
			(string) $element
		);
	}

	public function testElementGetContent(): void {
		$element = Element::create('div', 'Lorem ipsum.');

		$this->assertSame(
			'Lorem ipsum.',
			$element->getContent(Element::CKEY_DEFAULT_CONTENT)
		);

		$this->assertSame(
			'Default',
			$element->getContent('none', 'Default')
		);

		$content = 'Dolorem testapsum.';
		$element->placeContent('set', $content);

		$this->assertSame(
			$content,
			$element->getContent('none', $content)
		);
	}

	public function testElementGetChildrenByTagname(): void {
		$element = Element::create('div', 'Lorem ipsum.');
		$element->appendContent(Element::create('p', 'First paragraph.'));
		$element->appendContent(Element::create('hr'));
		$element->appendContent(Element::create('p', 'Second paragraph.'));

		$this->assertCount(
			2,
			$element->getChildrenByTagname('p')
		);

		$this->assertSame(
			'<div>Lorem ipsum.<p>First paragraph.</p><hr /><p>Second paragraph.</p></div>',
			(string) $element
		);
	}

}
