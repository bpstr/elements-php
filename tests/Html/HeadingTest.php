<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Anchor;
use Bpstr\Elements\Html\Heading;
use PHPUnit\Framework\TestCase;

final class HeadingTest extends TestCase {

	public function testNewInstance(): void {
		$heading = new Heading('This is a headline.');
		$this->assertSame(
			'<h1>This is a headline.</h1>',
			(string) $heading
		);
	}

	public function testMethodCreate(): void {
		$heading = Heading::create('h1', 'This is a headline.', ['class' => 'lead']);
		$heading->addClass('bold', 'white');
		$this->assertSame(
			'<h1 class="lead bold white">This is a headline.</h1>',
			(string) $heading
		);
	}

	public function testMethoBuild(): void {
		$heading = Heading::build(3, 'This is a headline.', ['class' => 'lead']);
		$heading->addClass('bold', 'white');
		$this->assertSame(
			'<h3 class="lead bold white">This is a headline.</h3>',
			(string) $heading
		);
	}

}
