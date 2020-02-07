<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Collection\UniqueStringCollection;

class ElementStyleCollection extends UniqueStringCollection {

	protected $implodePattern = '%s: %s;';
	protected $implodeSpacing = ' ';

}
