<?php

declare(strict_types=1);

use Bpstr\Elements\Base\Markup;
use PHPUnit\Framework\TestCase;

final class MarkupBaseTest extends TestCase {


	public function testElementWithoutContent(): void {
		$markup = Markup::create('document')->attr('created', date('Y-m-d'));
		$markup->content('title', Markup::create('title', 'Lorem ipsum.'));

		$this->assertSame(
			'<document created="2019-10-19"><title>Lorem ipsum.</title></document>',
			(string) $markup
		);
	}

}
