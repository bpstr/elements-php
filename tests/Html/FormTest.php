<?php

declare(strict_types=1);

use Bpstr\Elements\Html\Form;
use Bpstr\Elements\Html\Input;
use PHPUnit\Framework\TestCase;

final class FormTest extends TestCase {

	public function testNewInstance(): void {
		$input = new Input(Input::TYPE_TEXT, 'dummy', 'This __ rocks!');
		$this->assertSame('<input type="text" name="dummy" value="This __ rocks!" />', (string) $input);
	}

	public function testMethodBuild(): void {
		$input = Form::build('index.php');
		$this->assertSame('<form action="index.php" method="GET"></form>', (string) $input);
	}

	public function testFormAddFieldset(): void {
		$input = Input::build('random', 'words');
		$form = new Form('', '');
		$form->addFieldset('some.content', 'Fieldset', $input);
		$this->assertSame('<form action="" method=""><fieldset><legend>Fieldset</legend><input type="text" name="random" value="words" /></fieldset></form>', (string) $form);
	}
}
