<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Anchor;
use Bpstr\Elements\Html\Table;
use PHPUnit\Framework\TestCase;

final class TableTest extends TestCase {

	public function testSimpleTable(): void {
		$table = new Table(['a', 'b', 'c']);
		$this->assertSame(
			'<table><tbody><tr><td>a</td></tr><tr><td>b</td></tr><tr><td>c</td></tr></tbody></table>',
			(string) $table
		);
	}

	public function testMatrixTable(): void {
		$dataset = [
			['a', 'b', 'c'],
			['d', 'e', 'f'],
			['g', 'h', 'i'],
		];
		$table = new Table($dataset);

		$this->assertSame(
			'<table><tbody><tr><td>a</td><td>b</td><td>c</td></tr><tr><td>d</td><td>e</td><td>f</td></tr><tr><td>g</td><td>h</td><td>i</td></tr></tbody></table>',
			(string) $table
		);
	}

	public function testTableHeader(): void {
		$dataset = [
			['a', 'b', 'c'],
		];
		$table = new Table($dataset, ['A', 'B', 'C']);

		$this->assertSame(
			'<table><thead><tr><th>A</th><th>B</th><th>C</th></tr></thead><tbody><tr><td>a</td><td>b</td><td>c</td></tr></tbody></table>',
			(string) $table
		);
	}

	public function testTableFooter(): void {
		$dataset = [
			['a', 'b', 'c'],
		];
		$table = new Table($dataset, NULL, ['A', 'B', 'C']);

		$this->assertSame(
			'<table><tfoot><tr><td>A</td><td>B</td><td>C</td></tr></tfoot><tbody><tr><td>a</td><td>b</td><td>c</td></tr></tbody></table>',
			(string) $table
		);
	}

	public function testTableAppendRow(): void {
		$table = new Table([], ['A', 'B', 'C']);
		$table->appendRow(['d', 'e', 'f']);

		$this->assertSame(
			'<table><thead><tr><th>A</th><th>B</th><th>C</th></tr></thead><tbody><tr><td>d</td><td>e</td><td>f</td></tr></tbody></table>',
			(string) $table
		);
	}

}
