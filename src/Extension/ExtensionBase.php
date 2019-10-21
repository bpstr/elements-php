<?php

namespace Bpstr\Elements\Extension;

use Bpstr\Elements\Base\ElementInterface;

abstract class ExtensionBase implements ExtensionInterface {

	public static function attach(ElementInterface $element) {
		$extension = new static();
		$element->attachExtension($extension);
		return $extension;
	}

	abstract public function __invoke(ElementInterface $element);



}
