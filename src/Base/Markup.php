<?php

namespace Bpstr\Elements\Base;

use Exception;
use InvalidArgumentException;

/**
 * Simple SGTML markup element for Elements-php.
 * Original: https://github.com/bpstr/elements-php
 *
 * @bpstr Project Lifera <bpstr@gmx.tm>
 */
class Markup implements MarkupInterface {
	public const CKEY_DEFAULT_CONTENT = 0xF0000;

	/**
	 * @var string
	 *   HTML tag of the element
	 */
	protected $tag;

	/**
	 * @var \bpstr\Elements\Base\MarkupInterface
	 */
	protected $wrap;

	/**
	 * @var \bpstr\Elements\Base\MarkupInterface
	 */
	protected $before;

	/**
	 * @var \bpstr\Elements\Base\MarkupInterface
	 */
	protected $after;

	/**
	 * @var array
	 *   Contents of the HTML element
	 */
	protected $contents = [];

	/**
	 * @var array
	 */
	protected $attributes = [];


	/**
	 * {@inheritdoc}
	 */
	public static function create (string $tag, $content = NULL, iterable $attributes = []) {
		$markup = new static($tag);

		// Add content if exists.
		if ($content !== NULL) {
			$markup->content(self::CKEY_DEFAULT_CONTENT, $content);
		}

		// Add element attributes.
		foreach ($attributes as $name => $value) {
			$markup->attr($name, $value);
		}

		return $markup;
	}

	/**
	 * ElementBase constructor.
	 *
	 * @param string $tag
	 *   HTML Tag
	 */
	public function __construct(string $tag) {
		if ($tag === '') {
			throw new InvalidArgumentException('Markup tag must not be empty!');
		}
		$this->tag($tag);
	}

	/**
	 * {@inheritdoc}
	 */
	public function tag(string $tag) {
		$this->tag = $tag;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function wrap(MarkupInterface $wrap) {
		$this->wrap = $wrap;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function before(MarkupInterface $before) {
		$this->before = $before;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function after(MarkupInterface $after) {
		$this->after = $after;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function content($key, $content) {
		if (is_array($content)) {
			foreach ($content as $index => $subcontent) {
				$this->content(sprintf('%s.%s', $key, $index), $subcontent);
			}
			return $this;
		}
		$this->contents[$key] = $content;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function attr(string $attr, $value = NULL) {
		$this->attributes[$attr] = $value;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributes(iterable $attributes) {
		foreach ($attributes as $name => $value) {
			$this->attr($name, $value);
		}

		return $this;
	}


	/**
	 * {@inheritdoc}
	 */
	public function render(array $element = [], array $additional_attributes = []): string {
		$element += [
			'element' => NULL,
			'opening' => NULL,
			'content' => NULL,
			'closing' => NULL,
		];

		$opening_tag_contents = [$this->tag];
		foreach ($additional_attributes + $this->attributes as $name => $value) {
			$opening_tag_contents[] = sprintf('%s="%s"', trim($name), trim(str_replace('"', "'", (string) $value)));
		}

		$element['opening'] = sprintf('<%s>', implode(' ',  $opening_tag_contents));

		$element['content'] = implode($this->contents);

		$element['closing'] = sprintf('</%s>', $this->tag);

		if (!empty($this->before)) {
			array_unshift($element, $this->before);
		}

		if (!empty($this->after)) {
			$element[] = $this->after;
		}

		if ($this->wrap instanceof MarkupInterface) {
			return (string) $this->wrap->content(self::CKEY_DEFAULT_CONTENT, implode($element));
		}

		return implode($element);
	}

	public function serialize() {
		return [
			'tag' => $this->tag,
			'content' => $this->contents,
			'attributes' => $this->attributes,
			'relations' => [
				'before' => $this->before,
				'after' => $this->after,
				'wrap' => $this->wrap
			]
		];
	}

	public function unserialize($string): void {
		$unserialized = unserialize($string);
		$this->tag($unserialized['tag']);
	}

	public function jsonSerialize() {
		return $this->serialize();
	}

	public function __toString() {
		try {
			return $this->render();
		}
		catch (Exception $exception) {
			return sprintf('<!-- An error occured while rendering markup: %s in %s at line #%s -->', $exception->getMessage(), $exception->getFile(), $exception->getLine());
		}
	}

	public function __clone() {
		if ($this->before instanceof MarkupInterface) {
			$this->before = clone $this->before;
		}
		if ($this->after instanceof MarkupInterface) {
			$this->after = clone $this->after;
		}
		if ($this->wrap instanceof MarkupInterface) {
			$this->wrap = clone $this->wrap;
		}
	}

	public function __invoke($key, $content) {
		$this->content($key, $content);
		return $this;
	}

}
