<?php

namespace Bpstr\Elements\Html;

/**
 * Heading HTML element class for Bootstrap components.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Heading_Elements
 */
class Heading extends Element {

	public static function build($size, $content = NULL, iterable $attributes = []): Heading {
		$size = max(1, min(6, $size));
		$tag = "h$size";
		$heading = new static($tag);
		$heading->prepareContent($content);
		$heading->attributes($attributes);
		return $heading;
	}

	/**
	 * Heading constructor.
	 *
	 * @param string $tag
	 */
	public function __construct (string $tag = 'h2') {
		parent::__construct($tag);
	}

}
