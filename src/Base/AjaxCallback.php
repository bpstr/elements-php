<?php

namespace Bpstr\Elements\Base;

class AjaxCallback {

	protected $target;

	protected $callback;

	protected $attributes;

	public function __construct(string $target, callable $callback, string ...$attributes) {
		$this->target = $target;
		$this->callback = $callback;
		$this->attributes = $attributes;
	}

	public function __toString() {
		return sprintf("loadXMLDoc('%s', '%s', '%s');", $this->target, $this->callback, implode(',', $this->attributes));
	}
}
