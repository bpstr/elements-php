<?php

namespace Bpstr\Elements\Extension;

use Bpstr\Elements\Base\ElementInterface;

abstract class ExtensionBase implements ExtensionInterface {

	abstract public function handle(ElementInterface $element);

}
