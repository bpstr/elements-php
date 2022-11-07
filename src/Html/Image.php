<?php

namespace Bpstr\Elements\Html;

/**
 * Image HTML element class for elements-php.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/img
 */
class Image extends Element {

	public static function build(string $src, $alt = NULL, iterable $attributes = []): Image {
		$image = new static();
		$image->attr('src', $src);
		$image->attr('alt', $alt);
		$image->attributes($attributes);
		return $image;
	}

	/**
	 * Image constructor.
	 *
	 * @param string $tag
	 */
	public function __construct (string $tag = 'img') {
		parent::__construct($tag);
	}

}
