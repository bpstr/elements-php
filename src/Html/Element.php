<?php

namespace Bpstr\Elements\Html;

use Bpstr\Elements\Base\ElementAttributeCollection;
use Bpstr\Elements\Base\ElementClassCollection;
use Bpstr\Elements\Base\ElementContentCollection;
use Bpstr\Elements\Base\ElementInterface;
use Bpstr\Elements\Base\ElementStyleCollection;
use Bpstr\Elements\Base\Markup;
use Bpstr\Elements\Base\MarkupInterface;
use Bpstr\Elements\Extension\ExtensionInterface;

/**
 * Abstract HTML element class for Bootstrap components.
 * Original: https://github.com/bpstr/elements-php
 */
class Element extends Markup implements ElementInterface {
	public const CKEY_DEFAULT_CONTENT = 0xF0000;

	/**
	 * @var array
	 * 	 Collection of emlements to render without a closing tag.
	 */
	public const EMPTY_ELEMENTS = ['base', 'area', 'br', 'col', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr'];

	/**
	 * @var string
	 *   HTML tag of the element
	 */
	protected $tag;

	/**
	 * @var \bpstr\Elements\Base\ElementInterface
	 */
	protected $wrap;

	/**
	 * @var \bpstr\Elements\Base\ElementInterface
	 */
	protected $before;

	/**
	 * @var \bpstr\Elements\Base\ElementInterface
	 */
	protected $after;

	/**
	 * @var \Bpstr\Elements\Base\ElementContentCollection
	 *   Contents of the HTML element
	 */
	protected $contents;

	/**
	 * @var \Bpstr\Elements\Base\ElementAttributeCollection
	 */
	protected $attributes;

	/**
	 * @var ExtensionInterface[]
	 */
	protected $extensions = [];


	/**
	 * {@inheritdoc}
	 */
	public static function create (string $tag, $content = NULL, iterable $attributes = []) {
		$element = new static($tag);

		// Add content if exists.
		if ($content !== NULL) {
			$element->content(self::CKEY_DEFAULT_CONTENT, $content);
		}

		// Add element attributes.
		foreach ($attributes as $name => $value) {
			$element->setAttribute($name, $value);
		}

		return $element;
	}

	/**
	 * ElementBase constructor.
	 *
	 * @param string $tag
	 *   HTML Tag
	 */
	public function __construct(string $tag) {
		parent::__construct($tag);
		$this->contents = new ElementContentCollection();
		$this->attributes = new ElementAttributeCollection();
	}

	/**
	 * {@inheritdoc}
	 */
	public function setTag(string $tag): ElementInterface {
		$this->tag = $tag;
		return $this;
	}



	/**
	 * {@inheritdoc}
	 */
	public function content($key, $content): ElementInterface {
		return $this->placeContent($key, $content);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContent($key = NULL, $default = NULL) {
		return $this->contents->get($key, $default);
	}

	/**
	 * {@inheritdoc}
	 */
	public function prependContent($content): ElementInterface {
		$this->contents->prepend($content);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function appendContent($content = NULL): ElementInterface {
		$this->contents->append($content);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function placeContent($key, $content): ElementInterface {
		$this->contents->set($key, $content);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getChildrenByTagname(string $tag): array {
		$results = array();
		foreach ($this->contents as $key => $child) {
			if ($child instanceof MarkupInterface && $child->tag === $tag) {
				$results[$key] = $child;
			}
		}
		return $results;
	}


	/**
	 * {@inheritdoc}
	 */
	public function attr(string $attr, $value = NULL): ElementInterface {
		$this->setAttribute($attr, $value);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributes(iterable $attributes): ElementInterface {
		foreach ($attributes as $name => $value) {
			$this->setAttribute($name, $value);
		}

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAttributes(): ElementAttributeCollection {
		return $this->attributes;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAttribute(string $name, $default = NULL) {
		return $this->attributes->get($name, $default);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setAttribute(string $name, $value): ElementInterface {
		$this->attributes->set($name, $value);
		return $this;
	}

	public function removeAttribute(... $keys): ElementInterface {
		foreach ($keys as $key) {
			$this->attributes->remove($key);
		}
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasAttribute(string $name): bool {
		return $this->attributes->has($name);
	}

	/**
	 * {@inheritdoc}
	 */
	public function data(string $attr, $val): ElementInterface {
		if (strpos($attr, 'data-') === false) {
			$attr = 'data-' . $attr;
		}
		$this->setAttribute($attr, $val);
		return $this;
	}



	/**
	 * {@inheritdoc}
	 */
	public function getClasses(): ElementClassCollection {
		return $this->attributes->class();
	}

	/**
	 * {@inheritdoc}
	 */
	public function addClass(string ...$classes): ElementInterface {
		$this->attributes->class()->addMultiple($classes);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeClass(string $class): ElementInterface {
		$this->attributes->class()->remove($class);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasClass(string $class): bool {
		return $this->attributes->class()->has($class);
	}


	/**
	 * {@inheritdoc}
	 */
	public function style(string $property, $value): ElementInterface {
		$this->setStyle($property, $value);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getStyles(): ElementStyleCollection {
		return $this->attributes->style();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getStyle(string $property, $default = NULL) {
		return $this->attributes->style()->get($property, $default);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setStyle(string $property, $value): ElementInterface {
		$this->attributes->style()->set($property, $value);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasStyle(string $property): bool {
		return $this->attributes->style()->has($property);
	}



	public function attachExtension(string $key, ExtensionInterface $extension) {
		$this->extensions[] = $extension;
	}

	public function detachExtension(string $key) {
		unset($this->extensions[$key]);
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

		foreach ($this->extensions as $extension) {
			$extension->handle($this);
		}

		$is_empty_html_tag = in_array($this->tag, self::EMPTY_ELEMENTS, true);
		$first_tag_closing = $is_empty_html_tag ? '/' : '';

		if ($is_empty_html_tag && $this->contents->count()) {
			array_unshift($element, '<!-- Content dismissed in empty element with value attribute set (' .$this->tag .' : ' .var_export($this->contents, true). '-->');
		}

		$opening_tag_contents = [$this->tag];
		if ($this->attributes->count()) {
			$opening_tag_contents[] = $this->attributes;
		}

		if ($is_empty_html_tag) {
			$opening_tag_contents[] = $first_tag_closing;
		}

		$element['opening'] = sprintf('<%s>', implode(' ',  $opening_tag_contents));

		if (!$is_empty_html_tag) {
			$element['content'] = $this->contents;
			$element['closing'] = sprintf('</%s>', $this->tag);
		}

		if ($this->before instanceof ElementInterface) {
			array_unshift($element, $this->before);
		}

		if ($this->after instanceof ElementInterface) {
			$element[] = $this->after;
		}

		if ($this->wrap instanceof ElementInterface) {
			return (string) $this->wrap->content(self::CKEY_DEFAULT_CONTENT, $element);
		}

		return implode($element);
	}

}
