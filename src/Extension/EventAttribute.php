<?php

namespace Bpstr\Elements\Extension;

use Bpstr\Elements\Base\ElementInterface;

class EventAttribute extends ExtensionBase {

	/**
	 * @var array
	 */
	protected $events = [];

	public function __invoke(ElementInterface $element) {
		foreach ($this->events as $attribute => $event) {
			$element->attr($attribute, $event);
		}
	}

	public function onClick(string $value) {
		$this->events['onclick'] = $value;
		return $this;
	}

}
