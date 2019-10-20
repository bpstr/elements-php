<?php

namespace Bpstr\Elements\Html;

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
	 * @var string
	 */
	protected $tag = 'a';

	/**
	 * @var string
	 */
	protected $href;

	public static function create($href, $content = NULL, iterable $attributes = []) {
		return (new static($href))->content(self::CKEY_DEFAULT_CONTENT, $content)->attributes($attributes);
	}

	/**
	 * Anchor constructor.
	 *
	 * @param string $href
	 * @param null $target
	 */
	public function __construct (string $href, $target = NULL) {
		parent::__construct($this->tag);

		if ($href !== NULL) {
			$this->href($href);
		}

		if ($target !== NULL) {
			$this->target($target);
		}
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
