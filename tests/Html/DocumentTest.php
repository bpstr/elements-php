<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Document;
use Bpstr\Elements\Html\Element;
use PHPUnit\Framework\TestCase;

final class DocumentTest extends TestCase {

	public function testDocument(): void {
		$document = new Document('Some title');
		$document->title('HTML5');
		$document->attr('lang', 'en');

		$this->assertSame(
			'<!DOCTYPE html><html lang="en"><head><title>HTML5</title></head><body></body></html>',
			(string) $document
		);
	}

	public function testDocumentCreate() {
		$document = Document::create('Document Title', 'Lorem ipsum', ['lang' => 'fr']);
		$this->assertSame(
			'<!DOCTYPE html><html lang="fr"><head><title>Document Title</title></head><body>Lorem ipsum</body></html>',
			(string) $document
		);
	}

	public function testDocumentHead(): void {
		$document = new Document('HTML5');

		$document->head('meta', Element::create('meta', NULL, ['value' => 'ROBOTS']));

		$this->assertSame(
			'<!DOCTYPE html><html lang="en"><head><title>HTML5</title><meta value="ROBOTS" /></head><body></body></html>',
			(string) $document
		);
	}

	public function testDocumentBody(): void {
		$document = new Document('HTML');
		$document->title('HTML5');

		$document->body('content', Element::create('div', 'Lorem ipsum.'));

		$this->assertSame(
			'<!DOCTYPE html><html lang="en"><head><title>HTML5</title></head><body><div>Lorem ipsum.</div></body></html>',
			(string) $document
		);
	}


}
