<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\ElementInterface;

/**
 * Select HTML element class for elements-php.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/select
 */
class Select extends Element {

	public $tag = 'select';

	public $name;

	public $selected_value;

	public static function build(string $name, $options = NULL, iterable $attributes = []) {
		return (new static($name, (array) $options))->attributes($attributes);
	}

	/**
	 * Select constructor.
	 *
	 * @param string $name
	 * @param array $options
	 * @param string $selected
	 */
	public function __construct (string $name, array $options = [], $selected = NULL) {
		parent::__construct($this->tag);

		foreach ($options as $key => $option) {
			$this->addOption($key, $option, $selected == $key);
		}

		$this->attr('name', $name);
		$this->selected_value = $selected;
	}

	public function label(string $for, $content): self {
		$this->attr('id', $for);
		$this->before(Element::create('label', $content, ['for' => $for]));
		return $this;
	}

	public function multiple (): self {
		$this->attr('multiple', true);
		return $this;
	}

	/**
	 * Adding options
	 *
	 * @param string $value Value tag of element
	 * @param string $label Content of element
	 * @param bool $selected If the element is selected
	 * @param bool $disabled If the element is disabled
	 *
	 * @return $this
	 */
	public function addOption($value, $label = NULL, $selected = false, $disabled = false): self {
		if (empty($label)) {
			$label = ucfirst($value);
		}

		$attributes = ['value' => $value];
		if ($selected || $value === $this->selected_value || $label === $this->selected_value) {
			$attributes['selected'] = true;
		}
		if ($disabled) {
			$attributes['disabled'] = true;
		}

		$this->placeContent($value, Element::create('option', $label, $attributes));
		return $this;
	}

	public function activate($key) {
		if ($this->contents->has($key) && $this->contents->get($key) instanceof ElementInterface) {
			$this->contents->ref($key)->attr('selected', true);
		}
	}
}
