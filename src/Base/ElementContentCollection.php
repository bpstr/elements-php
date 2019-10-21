<?php

namespace Bpstr\Elements\Base;

use Bpstr\Elements\Collection\UniqueStringCollection;
use Bpstr\Elements\Html\Element;

class ElementContentCollection extends UniqueStringCollection {

	protected $itemWrapper;

	public function __construct(iterable $elements = [], ElementInterface $item_wrapper = NULL) {
		$this->itemWrapper = $item_wrapper;
		parent::__construct($elements);
	}

	public function set($key, $value): void {
		if ($this->itemWrapper instanceof ElementInterface) {
			$value = (clone $this->itemWrapper)->content(Element::CKEY_DEFAULT_CONTENT, $value);
		}

		parent::set($key, $value);
	}

	public function prepend($content) {
		if (is_iterable($content)) {
			foreach ($content as $item) {
				$this->prepend($item);
			}
			return;
		}

		if ($this->itemWrapper instanceof ElementInterface) {
			$content = (clone $this->itemWrapper)->appendContent($content);
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

		if ($this->itemWrapper instanceof ElementInterface) {
			$content = (clone $this->itemWrapper)->appendContent($content);
		}

		$this->storage[] = $content;
	}

	public function __toString() {
		return implode($this->storage);
	}

}
