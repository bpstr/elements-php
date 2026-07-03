<?php

namespace Bpstr\Elements\Html;

/**
 * Heading HTML element class for Bootstrap components.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Heading_Elements
 */
class Heading extends Element {

	public static function create(string $tag, $content = NULL, iterable $attributes = []) {
		$size = preg_match('/^h([1-6])$/', $tag, $matches) ? (int) $matches[1] : 1;
		$heading = new static($content, $size);
		$heading->setTag($tag);
		$heading->attributes($attributes);
		return $heading;
	}

	public static function build($size, $content = NULL, iterable $attributes = []): Heading {
		$heading = new static($content, $size);
		$heading->attributes($attributes);
		return $heading;
	}

	/**
	 * Heading constructor.
	 *
	 * @param mixed $content	Contents of heading tag
	 * @param int $size 		Size of heading tag
	 */
	public function __construct ($content, int $size = 1) {
		$size = max(1, min(6, $size));
		$tag = "h$size";
		parent::__construct($tag);

		if ($content !== NULL) {
			$this->appendContent($content);
		}
	}

}
