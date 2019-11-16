<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Input;
use Bpstr\Elements\Html\Select;
use PHPUnit\Framework\TestCase;

final class InputTest extends TestCase {

	public function testNewInstance(): void {
		$input = new Input(Input::TYPE_TEXT, 'dummy', 'This __ rocks!');
		$this->assertSame('<input type="text" name="dummy" value="This __ rocks!" />', (string) $input);
	}

	public function testMethodBuild(): void {
		$input = Input::build('random', 'words', Input::TYPE_TEXT);
		$this->assertSame('<input type="text" name="random" value="words" />', (string) $input);
	}

	public function testMagicMethodCreate(): void {
		$input = Input::text('random', 'words');
		$this->assertSame('<input type="text" name="random" value="words" />', (string) $input);

		$input = Input::password('random', 'words');
		$this->assertSame('<input type="password" name="random" value="words" />', (string) $input);
	}
}
