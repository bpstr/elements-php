<?php

namespace Bpstr\Elements\Extension;

use Bpstr\Elements\Base\ElementInterface;

interface ExtensionInterface {

	public function __invoke(ElementInterface $element);

}
