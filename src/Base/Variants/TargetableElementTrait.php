<?php

namespace Bpstr\Elements\Base\Variants;

use Bpstr\Elements\Html\Element;

class TargetableElement extends Element {

	const TARGET_SELF = '_self';
	const TARGET_BLANK = '_blank';
	const TARGET_PARENT = '_parent';
	const TARGET_TOP = '_top';

	public function target(string $str) {
		$this->attr('target', $str);
		return $this;
	}

}
