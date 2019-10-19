<?php

namespace Bpstr\Elements\Collection;

abstract class StringCollection {

	protected $implodePattern;
	protected $implodeSpacing;

	protected $storage = [];

	public function __construct(array $elements = []) {
		foreach ($elements as $index => $element) {
			$this->set($index, $element);
		}
	}

	public function count(): int {
		return count($this->storage);
	}

	public function has($key) {
		return !empty($this->storage[$key]);
	}

	public function set($key, $content) {
		$this->storage[$key] = $content;
	}

	public function remove($key) {
		unset($this->storage[$key]);
	}

	public function get($key, $default = NULL) {
		return $this->storage[$key] ?? $default;
	}

	public function list() {
		return $this->storage;
	}

	public function validate($value) {

		// Finally, all variables should be at least scalable.
		if (is_bool($value) || is_string($value) || is_scalar($value)) {
			return true;
		}

		// Convertable objects are turned into string.
		if (is_object($value) && method_exists($value, '__toString')) {
			return true;
		}

		return false;
	}

	public function __toString() {
		$items = [];
		foreach ($this->storage as $key => $current) {
			if ($this->validate($key) && $this->validate($current)) {
				$items[] = sprintf($this->implodePattern, trim($key), trim($current));
			}
		}

		return implode($this->implodeSpacing, $items);
	}

}
