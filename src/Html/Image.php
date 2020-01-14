<?php

namespace Bpstr\Elements\Html;

/**
 * Image HTML element class for elements-php.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/img
 */
class Image extends Element {

	protected $tag = 'img';

	public static function build(string $src, $alt = NULL, iterable $attributes = []): Image {
		$image = new static($src, (string) $alt);
		$image->attributes($attributes);
		return $image;
	}

	/**
	 * Image constructor.
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
