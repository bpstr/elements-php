<?php

namespace Bpstr\Elements\Html;

/**
 * Heading HTML element class for Bootstrap components.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/img
 */
class Image extends Element {

	protected $tag = 'img';

	public static function init(string $src, $alt = NULL, iterable $attributes = []) {
		return (new static($src, (string) $alt))->attributes($attributes);
	}


	/**
	 * Heading constructor.
	 *
	 * @param string $src
	 * @param string $alt
	 */
	public function __construct (string $src, string $alt = '') {
		parent::__construct($this->tag);

		$this->attr('src', $src);
		$this->attr('alt', $alt);
	}

}
