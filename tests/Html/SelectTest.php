<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Select;
use PHPUnit\Framework\TestCase;

final class SelectTest extends TestCase {

	public function testNewInstance(): void {
		$cities = ['BUD' => 'Budapest', 'KIN' => 'Kingston'];
		$select = new Select( 'city', $cities, 'KIN');
		$this->assertSame(
			'<select name="city"><option value="BUD">Budapest</option><option value="KIN" selected="selected">Kingston</option></select>',
			(string) $select
		);
	}

	public function testMethodCreate(): void {
		$cities = ['BUD' => 'Budapest', 'KIN' => 'Kingston'];
		$select = Select::create( 'city', $cities);
		$select->activate('KIN');
		$this->assertSame(
			'<select name="city"><option value="BUD">Budapest</option><option value="KIN" selected="selected">Kingston</option></select>',
			(string) $select
		);
	}

}
