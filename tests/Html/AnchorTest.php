<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Anchor;
use PHPUnit\Framework\TestCase;

final class AnchorTest extends TestCase {

	public function testAnchor(): void {
		$anchor = new Anchor('#', Anchor::TARGET_BLANK);
		$anchor->content(Anchor::CKEY_DEFAULT_CONTENT, 'This is a link.');
		$this->assertSame(
			'<a href="#" target="_blank">This is a link.</a>',
			(string) $anchor
		);
	}

	public function testAnchorCreate(): void {
		$anchor = Anchor::create('#', 'This is a link.');
		$anchor->target(Anchor::TARGET_BLANK);
		$this->assertSame(
			'<a href="#" target="_blank">This is a link.</a>',
			(string) $anchor
		);
	}

}
