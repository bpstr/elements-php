<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Image;
use PHPUnit\Framework\TestCase;

final class ImageTest extends TestCase {

	public function testNewInstance(): void {
		$image = new Image('image.jpg', 'A simple image');
		$this->assertSame(
			'<img src="image.jpg" alt="A simple image" />',
			(string) $image
		);
	}

	public function testMethodCreate(): void {
		$image = Image::create('image.jpg', 'A simple image', ['class' => 'responsive']);
		$this->assertSame(
			'<img src="image.jpg" alt="A simple image" class="responsive" />',
			(string) $image
		);
	}

}
