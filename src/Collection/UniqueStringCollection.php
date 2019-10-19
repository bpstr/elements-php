<?php

namespace Bpstr\Elements\Collection;

abstract class UniqueStringCollection extends StringCollection {

	protected $implodePattern;
	protected $implodeSpacing;

	/**
	 * {@inheritdoc}
	 */
	public function set($key, $value): void {
		if (!is_scalar($key) || !$this->validate($value)) {
			return;
		}

		// Present boolean attributes are added with exact match.
		if ($value === true) {
			parent::set($key, $key);
		}

		parent::set($key, $value);
	}

}
