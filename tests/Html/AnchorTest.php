<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Anchor;
use PHPUnit\Framework\TestCase;

final class AnchorTest extends TestCase {

	public function testAnchor(): void {
		$anchor = new Anchor();
		$anchor->href('#')->target('_blank');
		$anchor->content(Anchor::CKEY_DEFAULT_CONTENT, 'This is a link.');
		$this->assertSame(
			'<a href="#" target="_blank">This is a link.</a>',
			(string) $anchor
		);
	}

	public function testAnchorCreate(): void {
		$anchor = Anchor::build('#', 'This is a link.');
		$anchor->target(Anchor::TARGET_BLANK);
		$this->assertSame(
			'<a href="#" target="_blank">This is a link.</a>',
			(string) $anchor
		);
	}

}
