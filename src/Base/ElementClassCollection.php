<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Collection\UniqueStringCollection;

class ElementClassCollection extends UniqueStringCollection {

	protected $implodeSpacing = ' ';

	public function has($class): bool {
		return in_array($class, $this->storage);
	}

	public function add(string $class) {
		$classes = preg_split('/\s+/', $class);
		array_push($this->storage, ...$classes);
	}

	public function addMultiple(array $classes) {
		foreach ($classes as $class) {
			$this->add($class);
		}
	}

	public function remove($class) {
		$key = array_search($class, $this->storage);
		if ($key !== false) {
			unset($this->storage[$key]);
		}
	}

	public function __toString() {
		return implode($this->implodeSpacing, array_unique($this->storage));
	}

}
