<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Collection\UniqueStringCollection;

class ElementContentCollection extends UniqueStringCollection {

	public function prepend($content) {
		if (is_iterable($content)) {
			foreach ($content as $item) {
				$this->prepend($item);
			}
			return;
		}

		array_unshift($this->storage, $content);
	}

	public function append($content) {
		if (is_iterable($content)) {
			foreach ($content as $item) {
				$this->append($item);
			}
			return;
		}

		$this->storage[] = $content;
	}

	public function __toString() {
		return implode($this->storage);
	}

}
