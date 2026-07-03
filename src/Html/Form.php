<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\ElementInterface;
use Bpstr\Elements\Base\Variants\TargetableElement;

/**
 * Form HTML element class for elements-php.
 * Original: https://github.com/bpstr/elements-php
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/form
 */
class Form extends TargetableElement {

	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';

	const ENCTYPE_DEFAULT = 'application/x-www-form-urlencoded';
	const ENCTYPE_FILE_UPLOAD = 'multipart/form-data';
	const ENCTYPE_PLAIN_TEXT = 'text/plain';

	public $tag = 'form';

	public static function build(string $action, $content = NULL, iterable $attributes = []) {
		$element = new static($action);
		$element->content(self::CKEY_DEFAULT_CONTENT, $content)->attributes($attributes);
		return $element;
	}

	/**
	 * Form constructor.
	 *
	 * @param string $action
	 * @param string $method
	 */
	public function __construct(string $action, string $method = self::METHOD_GET) {
		parent::__construct($this->tag);
		$this->attr('action', $action);
		$this->method($method);
	}

	public function method(string $method = self::METHOD_GET) {
		$this->attr('method', $method);
		return $this;
	}

	public function novalidate(bool $state = TRUE): self {
		$this->attr('novalidate', $state);
		return $this;
	}

	public function autocomplete(bool $state = TRUE) {
		$this->attr('autocomplete', $state ? 'on' : 'off');
		return $this;
	}

	public function enctype(string $mime) {
		$this->attr('enctype', $mime);
		return $this;
	}

	/**
	 * Adding options
	 *
	 * @param string $key
	 * @param string $legend
	 * @param $content
	 *
	 * @return $this
	 */
	public function addFieldset(string $key, string $legend, $content): self {
		if (!$content instanceof ElementInterface || $content->getTag() !== 'fieldset') {
			$fieldset = Element::create('fieldset', $content)->prependContent(
				Element::create('legend', $legend)
			);
		}
		$this->placeContent($key, $fieldset ?? $content);
		return $this;
	}

}
