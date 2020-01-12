<?php

namespace Bpstr\Elements\Html;

/**
 * Input HTML element class for elements-php.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input
 *
 * @method static text($name, $value)
 * @method static password($name, $value)
 * @method static submit($name, $value)
 * @method static reset($name, $value)
 * @method static radio($name, $value)
 * @method static checkbox($name, $value)
 * @method static button($name, $value)
 * @method static color($name, $value)
 * @method static date($name, $value)
 * @method static datetime($name, $value)
 * @method static email($name, $value)
 * @method static file($name, $value)
 * @method static month($name, $value)
 * @method static number($name, $value)
 * @method static range($name, $value)
 * @method static search($name, $value)
 * @method static tel($name, $value)
 * @method static time($name, $value)
 * @method static url($name, $value)
 * @method static week($name, $value)
 */
class Input extends Element {
	const TYPE_TEXT = 'text';
	const TYPE_PASSWORD = 'password';
	const TYPE_SUBMIT = 'submit';
	const TYPE_RESET = 'reset';
	const TYPE_RADIO = 'radio';
	const TYPE_CHECKBOX = 'checkbox';
	const TYPE_BUTTON = 'button';
	const TYPE_COLOR = 'color';
	const TYPE_DATE = 'date';
	const TYPE_DATETIME = 'datetime-local';
	const TYPE_EMAIL = 'email';
	const TYPE_FILE = 'file';
	const TYPE_MONTH = 'month';
	const TYPE_NUMBER = 'number';
	const TYPE_RANGE = 'range';
	const TYPE_SEARCH = 'search';
	const TYPE_TEL = 'tel';
	const TYPE_TIME = 'time';
	const TYPE_URL = 'url';
	const TYPE_WEEK = 'week';

	public $tag = 'input';

	public static function build(string $name = NULL, $value = NULL, string $type = self::TYPE_TEXT, iterable $attributes = []) {
		return (new static($type, $name, $value))->attributes($attributes);
	}

	/**
	 * Allows dynamically creating input fields of a given type.
	 *
	 * @param $type
	 * @param $arguments
	 *
	 * @return \Bpstr\Elements\Html\Input
	 */
	public static function __callStatic($type, $arguments) {
		if (constant(sprintf('%s::TYPE_%s', static::class, strtoupper($type))) === NULL) {
			$type = self::TYPE_TEXT;
		}
		return new static($type, ...$arguments);
	}

	/**
	 * Construct Input
	 *
	 * @param string $type
	 * @param mixed $name
	 * @param mixed $value
	 */
	function __construct (string $type = self::TYPE_TEXT, string $name = NULL, $value = NULL) {
		parent::__construct($this->tag);

		$this->type($type);

		if ($name !== NULL) {
			$this->attr('name', $name);
		}

		if ($value !== NULL) {
			$this->attr('value', $value);
		}

	}

	public function type ($type) {
		if (constant(sprintf('%s::TYPE_%s', static::class, strtoupper($type))) === NULL) {
			$type = self::TYPE_TEXT;
		}
		$this->attr('type', $type);
		return $this;
	}

}
