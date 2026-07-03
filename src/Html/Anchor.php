<?php

namespace bpstr\Elements\Html;

use bpstr\Elements\Base\Variants\TargetableElement;

/**
 * Anchor HTML element class for Bootstrap components.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a
 */
class Anchor extends Element {

	const TARGET_SELF = '_self';
	const TARGET_BLANK = '_blank';
	const TARGET_PARENT = '_parent';
	const TARGET_TOP = '_top';
	/**
	 * @param string $href
	 * @param mixed|null $content
	 * @param iterable $attributes
	 *
	 * @return \Bpstr\Elements\Html\Anchor
	 */
	public static function build(string $href, $content = NULL, iterable $attributes = []) {
		$anchor = new static();
		$anchor->href($href);
		$anchor->prepareContent($content);
		$anchor->attributes($attributes);
		return $anchor;
	}

	/**
	 * Anchor constructor.
	 *
	 * @param string $tag
	 */
	public function __construct (string $tag = 'a') {
		parent::__construct($tag);
	}

	public function href(string $str) {
		$this->attr('href', $str);
		return $this;
	}

	public function target(string $str) {
		$this->attr('target', $str);
		return $this;
	}

}
